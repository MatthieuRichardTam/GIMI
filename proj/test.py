import pandas as pd
import mysql.connector

incomp_file_path = "C:/xampp/htdocs/proj/Donnée-imcompatibilitées (1).csv"
incomp = pd.read_csv(incomp_file_path, encoding='latin1')

# Connectez-vous à votre base de données
cnx = mysql.connector.connect(user='root', password='',
                              host='localhost',
                              database='hi')

# Créez un nouveau curseur
cursor = cnx.cursor()

# Exécutez la requête pour récupérer les données de la table
query = "SELECT drug1, drug2 FROM mytable ORDER BY id DESC LIMIT 1"
cursor.execute(query)

#symetrisation du DataFrame
Medic = incomp.columns.tolist()
n = len(Medic)-2
for k in range(1, n+1):
    for i in range(k, n-1):
        incomp.iloc[k-1,i+1]=incomp.iloc[i,k]

Additionnal_medic = ["TPN_avec_lipides_ternaire", "TPN_sans_lipides_binaire", "RINGER-LACTATE", "GLUCOSALIN", "GLUCOSE_5%_et_10%", "NaCl_0.9%"]
for medicAdd in Additionnal_medic:
    Medic.append(medicAdd)

def fct(drug1, drug2):
    assert drug1 in Medic
    objet = incomp.loc[(incomp.Medicaments == drug2), drug1]
    index_objet = objet.index[0]
    reponse = objet[index_objet]
    if reponse == "I":
        return "{} est incompatible avec {} pour une injection en Y".format(drug1, drug2)
    if reponse == "C":
        return "{} est compatible avec {} pour une injection en Y".format(drug1, drug2)
    if reponse == "nan":
        return "Nous n'avons pas d'information sur l'interaction de ces médicaments"
    else:
        return "Se référer au code {} dans la documentation".format(reponse)

# Parcourez les résultats
for (drug1, drug2) in cursor:
    print("Drug1: {}, Drug2: {}".format(drug1, drug2))

    result = fct(drug1, drug2)
    print(result)
    print(result)
   
    query = "INSERT INTO result_table (result_column) VALUES (%s)"
    cursor.execute(query, (result,))

    # Validation des modifications
    cnx.commit()

# Fermeture du curseur et de la connexion
cursor.close()
cnx.close()
