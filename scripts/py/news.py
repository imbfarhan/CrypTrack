import json
import requests
import mysql.connector
import time
import random

max=29
max_page_number=50

mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
)
mycursor=mydb.cursor()

title=""
link=""
description=""
pubDate=""
img=""

url_news_info = "https://newsdata.io/api/1/news?apikey=pub_132134d451cd1c2ccc43ade6f96a4851f0268&q=bitcoin%20OR%20ethereum%20OR%20bnb%20OR%20binance%20OR%20dogecoin%20OR%20doge%20OR%20usdt%20OR%20tether&language=en "

api_resp=requests.get(url_news_info)
js_resp=api_resp.json()
if(api_resp.status_code==200):
    for i in range (0,6):
        random_page_number=random.randint(1,max_page_number)
        random_page_number=str(random_page_number)
        random_index=random.randint(0,max)
        api_image = "https://api.unsplash.com/search/photos?&query=cryptocurrency&page="+random_page_number+"&orientation=landscape&page=1&per_page=2000&client_id=D5GFozciCUDHpmUtY2PI-lLsfE141oMqYTXOT0Nrxmg"
        api_resp_img=requests.get(api_image)
        js_resp_img=api_resp_img.json()
        if(api_resp_img.status_code==200):
            random_index=random.randint(0,max)
            img=js_resp_img['results'][random_index]['urls']['small']
        else:
            img=""

        title=js_resp['results'][i]['title']
        link=js_resp['results'][i]['link']
        description=js_resp['results'][i]['description']
        pubDate=js_resp['results'][i]['pubDate']
        # # mycursor.execute ("UPDATE cryptrack.crypto SET price='%s' WHERE cid='%s'",(btc_price,1))
        mycursor.execute ("INSERT into cryptrack.news (ntitle,ndesc,ndate,nlink,nimg) values (%s,%s,%s,%s,%s)",(title,description,pubDate,link,img))
        mydb.commit()
    print("News fetched and updated into CrypTrack.")
else:
    print("ERROR OCCURED ! RESPONSE CODE:"+api_resp.status_code)


    

