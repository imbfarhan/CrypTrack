import json
import requests
import mysql.connector
import time

delay_time=30

mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
)

url_crypto_info="https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=bitcoin%2Cethereum%2Ctether%2Cdogecoin%2Cbinancecoin&order=id_asc&per_page=100&page=1&sparkline=false&price_change_percentage=24h%2C7d%2C30d%2C1y"


mycursor=mydb.cursor()

while(1):
    t = time.localtime()
    current_time = time.strftime("%H:%M:%S", t)
    api_resp=requests.get(url_crypto_info)
    js_resp=api_resp.json()
    
    if(api_resp.status_code==200):
        btc_24h_high=""
        btc_24h_low=""
        btc_24h_change=""
        btc_7d_change=""
        btc_1y_change=""
        btc_circulating_supply=""
        btc_total_supply=""
        btc_market_cap=""

        #FOR BNB
        bnb_price=js_resp[0]['current_price']
        bnb_24h_high=js_resp[0]['high_24h']
        bnb_24h_low=js_resp[0]['low_24h']
        bnb_24h_change=js_resp[0]['price_change_percentage_24h_in_currency']
        bnb_7d_change=js_resp[0]['price_change_percentage_7d_in_currency']
        bnb_30d_change=js_resp[0]['price_change_percentage_30d_in_currency']
        bnb_1y_change=js_resp[0]['price_change_percentage_1y_in_currency']
        bnb_circulating_supply=js_resp[0]['circulating_supply']
        bnb_total_supply=js_resp[0]['total_supply']
        bnb_market_cap=js_resp[0]['market_cap']

        #FOR BTC
        btc_price=js_resp[1]['current_price']
        btc_24h_high=js_resp[1]['high_24h']
        btc_24h_low=js_resp[1]['low_24h']
        btc_24h_change=js_resp[1]['price_change_percentage_24h_in_currency']
        btc_7d_change=js_resp[1]['price_change_percentage_7d_in_currency']
        btc_30d_change=js_resp[1]['price_change_percentage_30d_in_currency']
        btc_1y_change=js_resp[1]['price_change_percentage_1y_in_currency']
        btc_circulating_supply=js_resp[1]['circulating_supply']
        btc_total_supply=js_resp[1]['total_supply']
        btc_market_cap=js_resp[1]['market_cap']

        #FOR DOGECOIN
        doge_price=js_resp[2]['current_price']
        doge_24h_high=js_resp[2]['high_24h']
        doge_24h_low=js_resp[2]['low_24h']
        doge_24h_change=js_resp[2]['price_change_percentage_24h_in_currency']
        doge_7d_change=js_resp[2]['price_change_percentage_7d_in_currency']
        doge_30d_change=js_resp[2]['price_change_percentage_30d_in_currency']
        doge_1y_change=js_resp[2]['price_change_percentage_1y_in_currency']
        doge_circulating_supply=js_resp[2]['circulating_supply']
        doge_total_supply=js_resp[2]['total_supply']
        doge_market_cap=js_resp[2]['market_cap']

        #FOR ETHEREUM
        eth_price=js_resp[3]['current_price']
        eth_24h_high=js_resp[3]['high_24h']
        eth_24h_low=js_resp[3]['low_24h']
        eth_24h_change=js_resp[3]['price_change_percentage_24h_in_currency']
        eth_7d_change=js_resp[3]['price_change_percentage_7d_in_currency']
        eth_30d_change=js_resp[3]['price_change_percentage_30d_in_currency']
        eth_1y_change=js_resp[3]['price_change_percentage_1y_in_currency']
        eth_circulating_supply=js_resp[3]['circulating_supply']
        eth_total_supply=js_resp[3]['total_supply']
        eth_market_cap=js_resp[3]['market_cap']

        #FOR TETHER
        usdt_price=js_resp[4]['current_price']
        usdt_24h_high=js_resp[4]['high_24h']
        usdt_24h_low=js_resp[4]['low_24h']
        usdt_24h_change=js_resp[4]['price_change_percentage_24h_in_currency']
        usdt_7d_change=js_resp[4]['price_change_percentage_7d_in_currency']
        usdt_30d_change=js_resp[4]['price_change_percentage_30d_in_currency']
        usdt_1y_change=js_resp[4]['price_change_percentage_1y_in_currency']
        usdt_circulating_supply=js_resp[4]['circulating_supply']
        usdt_total_supply=js_resp[4]['total_supply']
        usdt_market_cap=js_resp[4]['market_cap']
        
        #UPDATE BTC
        mycursor.execute ("UPDATE cryptrack.crypto SET price='%s' WHERE cid='%s'",(btc_price,1))
        mycursor.execute ("UPDATE cryptrack.crypto SET 24h_high='%s' WHERE cid='%s'",(btc_24h_high,1))
        mycursor.execute ("UPDATE cryptrack.crypto SET 24h_low='%s' WHERE cid='%s'",(btc_24h_low,1))
        mycursor.execute ("UPDATE cryptrack.crypto SET 24h_change='%s' WHERE cid='%s'",(btc_24h_change,1))
        mycursor.execute ("UPDATE cryptrack.crypto SET 7d_change='%s' WHERE cid='%s'",(btc_7d_change,1))
        mycursor.execute ("UPDATE cryptrack.crypto SET 30d_change='%s' WHERE cid='%s'",(btc_30d_change,1))
        mycursor.execute ("UPDATE cryptrack.crypto SET 1y_change='%s' WHERE cid='%s'",(btc_1y_change,1))
        mycursor.execute ("UPDATE cryptrack.crypto SET total_supply='%s' WHERE cid='%s'",(btc_total_supply,1))
        mycursor.execute ("UPDATE cryptrack.crypto SET circulating_supply='%s' WHERE cid='%s'",(btc_circulating_supply,1))
        mycursor.execute ("UPDATE cryptrack.crypto SET market_cap='%s' WHERE cid='%s'",(btc_market_cap,1))
        mydb.commit()

        #UPDATE ETH
        mycursor.execute ("UPDATE cryptrack.crypto SET price='%s' WHERE cid='%s'",(eth_price,2))
        mycursor.execute ("UPDATE cryptrack.crypto SET 24h_high='%s' WHERE cid='%s'",(eth_24h_high,2))
        mycursor.execute ("UPDATE cryptrack.crypto SET 24h_low='%s' WHERE cid='%s'",(eth_24h_low,2))
        mycursor.execute ("UPDATE cryptrack.crypto SET 24h_change='%s' WHERE cid='%s'",(eth_24h_change,2))
        mycursor.execute ("UPDATE cryptrack.crypto SET 7d_change='%s' WHERE cid='%s'",(eth_7d_change,2))
        mycursor.execute ("UPDATE cryptrack.crypto SET 30d_change='%s' WHERE cid='%s'",(eth_30d_change,2))
        mycursor.execute ("UPDATE cryptrack.crypto SET 1y_change='%s' WHERE cid='%s'",(eth_1y_change,2))
        mycursor.execute ("UPDATE cryptrack.crypto SET total_supply='%s' WHERE cid='%s'",(eth_total_supply,2))
        mycursor.execute ("UPDATE cryptrack.crypto SET circulating_supply='%s' WHERE cid='%s'",(eth_circulating_supply,2))
        mycursor.execute ("UPDATE cryptrack.crypto SET market_cap='%s' WHERE cid='%s'",(eth_market_cap,2))
        mydb.commit()

        #UPDATE BNB
        mycursor.execute ("UPDATE cryptrack.crypto SET price='%s' WHERE cid='%s'",(bnb_price,3))
        mycursor.execute ("UPDATE cryptrack.crypto SET 24h_high='%s' WHERE cid='%s'",(bnb_24h_high,3))
        mycursor.execute ("UPDATE cryptrack.crypto SET 24h_low='%s' WHERE cid='%s'",(bnb_24h_low,3))
        mycursor.execute ("UPDATE cryptrack.crypto SET 24h_change='%s' WHERE cid='%s'",(bnb_24h_change,3))
        mycursor.execute ("UPDATE cryptrack.crypto SET 7d_change='%s' WHERE cid='%s'",(bnb_7d_change,3))
        mycursor.execute ("UPDATE cryptrack.crypto SET 30d_change='%s' WHERE cid='%s'",(bnb_30d_change,3))
        mycursor.execute ("UPDATE cryptrack.crypto SET 1y_change='%s' WHERE cid='%s'",(bnb_1y_change,3))
        mycursor.execute ("UPDATE cryptrack.crypto SET total_supply='%s' WHERE cid='%s'",(bnb_total_supply,3))
        mycursor.execute ("UPDATE cryptrack.crypto SET circulating_supply='%s' WHERE cid='%s'",(bnb_circulating_supply,3))
        mycursor.execute ("UPDATE cryptrack.crypto SET market_cap='%s' WHERE cid='%s'",(bnb_market_cap,3))
        mydb.commit()

        #UPDATE DOGE
        mycursor.execute ("UPDATE cryptrack.crypto SET price='%s' WHERE cid='%s'",(doge_price,4))
        mycursor.execute ("UPDATE cryptrack.crypto SET 24h_high='%s' WHERE cid='%s'",(doge_24h_high,4))
        mycursor.execute ("UPDATE cryptrack.crypto SET 24h_low='%s' WHERE cid='%s'",(doge_24h_low,4))
        mycursor.execute ("UPDATE cryptrack.crypto SET 24h_change='%s' WHERE cid='%s'",(doge_24h_change,4))
        mycursor.execute ("UPDATE cryptrack.crypto SET 7d_change='%s' WHERE cid='%s'",(doge_7d_change,4))
        mycursor.execute ("UPDATE cryptrack.crypto SET 30d_change='%s' WHERE cid='%s'",(doge_30d_change,4))
        mycursor.execute ("UPDATE cryptrack.crypto SET 1y_change='%s' WHERE cid='%s'",(doge_1y_change,4))
        mycursor.execute ("UPDATE cryptrack.crypto SET total_supply='%s' WHERE cid='%s'",(doge_total_supply,4))
        mycursor.execute ("UPDATE cryptrack.crypto SET circulating_supply='%s' WHERE cid='%s'",(doge_circulating_supply,4))
        mycursor.execute ("UPDATE cryptrack.crypto SET market_cap='%s' WHERE cid='%s'",(doge_market_cap,4))
        mydb.commit()

        #UPDATE USDT
        mycursor.execute ("UPDATE cryptrack.crypto SET price='%s' WHERE cid='%s'",(usdt_price,5))
        mycursor.execute ("UPDATE cryptrack.crypto SET 24h_high='%s' WHERE cid='%s'",(usdt_24h_high,5))
        mycursor.execute ("UPDATE cryptrack.crypto SET 24h_low='%s' WHERE cid='%s'",(usdt_24h_low,5))
        mycursor.execute ("UPDATE cryptrack.crypto SET 24h_change='%s' WHERE cid='%s'",(usdt_24h_change,5))
        mycursor.execute ("UPDATE cryptrack.crypto SET 7d_change='%s' WHERE cid='%s'",(usdt_7d_change,5))
        mycursor.execute ("UPDATE cryptrack.crypto SET 30d_change='%s' WHERE cid='%s'",(usdt_30d_change,5))
        mycursor.execute ("UPDATE cryptrack.crypto SET 1y_change='%s' WHERE cid='%s'",(usdt_1y_change,5))
        mycursor.execute ("UPDATE cryptrack.crypto SET total_supply='%s' WHERE cid='%s'",(usdt_total_supply,5))
        mycursor.execute ("UPDATE cryptrack.crypto SET circulating_supply='%s' WHERE cid='%s'",(usdt_circulating_supply,5))
        mycursor.execute ("UPDATE cryptrack.crypto SET market_cap='%s' WHERE cid='%s'",(usdt_market_cap,5))
        mydb.commit()
        print("Data updated at",current_time)

    else:
        print("ERROR OCCURED ! RESPONSE CODE:"+api_resp.status_code)

    time.sleep(delay_time)
