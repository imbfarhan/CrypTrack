

import json
import requests
import mysql.connector
import time
import random
max=29
max_page_number=50
random_page_number=random.randint(1,max_page_number)
random_page_number=str(random_page_number)
# print(js_resp['results'][random_index]['urls']['small'])
api_image = "https://api.unsplash.com/search/photos?&query=cryptocurrency&page="+random_page_number+"&orientation=landscape&page=1&per_page=2000&client_id=D5GFozciCUDHpmUtY2PI-lLsfE141oMqYTXOT0Nrxmg"

api_resp_img=requests.get(api_image)
js_resp_img=api_resp_img.json()
if(api_resp_img.status_code==200):
   random_index=random.randint(0,max)
   
   
   print(js_resp_img['results'][random_index]['urls']['small'])
else:
    print("ERROR OCCURED ! RESPONSE CODE:"+str(api_resp_img.status_code))
