import requests
import json

response = requests.get("https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd")


baba=requests.get("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=bitcoin&order=market_cap_desc&per_page=100&page=1&sparkline=false&price_change_percentage=1h%2C24h")


test=baba.json()

new=response.json()

boy=str(test)




if('circulating_supply' in boy):
    print("yes")
    indx=boy.index('current_price')
    print(indx)
    number=int(boy[indx+16:indx+21])
    print(number)
    print(type(number))
else:
    print("no")
