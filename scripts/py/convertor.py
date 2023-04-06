import json
import requests
import mysql.connector
import time

url = 'https://api.exchangerate.host/latest'
response = requests.get(url)
data = response.json()

#rates of top 5 currency
aed=data['rates']['AED']
eur=data['rates']['EUR']
inr=data['rates']['INR']
usd=data['rates']['USD']
jpy=data['rates']['JPY']
AED="AED"
EUR="EUR"
INR="INR"
USD="USD"
JPY="JPY"

mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
)

mycursor=mydb.cursor()

cur_price=""
cur_id=""



#FOR AED
mycursor.execute ("UPDATE cryptrack.convertor SET cur_price='%s' WHERE cur_id='%s'",(aed,1))
mydb.commit()


#FOR INR
mycursor.execute ("UPDATE cryptrack.convertor SET cur_price='%s' WHERE cur_id='%s'",(inr,2))
mydb.commit()


#FOR USD
mycursor.execute ("UPDATE cryptrack.convertor SET cur_price='%s' WHERE cur_id='%s'",(usd,3))
mydb.commit()


#FOR EUR
mycursor.execute ("UPDATE cryptrack.convertor SET cur_price='%s' WHERE cur_id='%s'",(eur,4))
mydb.commit()


#FOR JPY
mycursor.execute ("UPDATE cryptrack.convertor SET cur_price='%s' WHERE cur_id='%s'",(jpy,5))
mydb.commit()
print("Converter prices updated successfully.")
