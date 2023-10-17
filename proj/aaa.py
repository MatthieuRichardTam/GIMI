import mysql.connector

# Connect to MySQL database
cnx = mysql.connector.connect(user='root', password='',
                              host='localhost',
                              database='hi')

cursor = cnx.cursor()

# Create table
cursor.execute("CREATE TABLE employees (first_name VARCHAR(14), last_name VARCHAR(14))")

# Insert a row of data
add_employee = ("INSERT INTO employees "
               "(first_name, last_name) "
               "VALUES (%s, %s)")
data_employee = ('John', 'Doe')
cursor.execute(add_employee, data_employee)

# Commit the changes
cnx.commit()

# Close the cursor and connection
cursor.close()
cnx.close()
