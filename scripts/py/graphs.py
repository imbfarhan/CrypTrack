import matplotlib.pyplot as plt
import numpy as np
import datetime
import requests


url_btc="https://api.coingecko.com/api/v3/coins/bitcoin/market_chart?vs_currency=usd&days=1&interval=hourly"
url_eth="https://api.coingecko.com/api/v3/coins/ethereum/market_chart?vs_currency=usd&days=1&interval=hourly"
url_bnb="https://api.coingecko.com/api/v3/coins/binancecoin/market_chart?vs_currency=usd&days=1&interval=hourly"
url_doge="https://api.coingecko.com/api/v3/coins/dogecoin/market_chart?vs_currency=usd&days=1&interval=hourly"
url_tether="https://api.coingecko.com/api/v3/coins/tether/market_chart?vs_currency=usd&days=1&interval=hourly"


def graph_btc():
    resp=requests.get(url_btc)
    js_resp=resp.json()
    j=0
    # x=js_resp['prices'][2][0]
    if(resp.status_code==200):
        #CONVERT UTC TIME TO READABLE TIME
        list_timestamp=[]
        for i in range (len(js_resp['prices'])):
            list_timestamp.append(js_resp['prices'][i][0])
            list_timestamp[i]/=1000

        i=0
        list_datetime=[]
        #GET HOURS AND MINUTE FROM THE READABLE TIME
        for i in range (len(js_resp['prices'])):
            string_date=datetime.datetime.fromtimestamp(list_timestamp[i]).strftime('%Y-%m-%d %H-%M-%S')
            s1=str((datetime.datetime.strptime(string_date,"%Y-%m-%d %H-%M-%S")).hour)
            s2=str((datetime.datetime.strptime(string_date,"%Y-%m-%d %H-%M-%S")).minute)
            s3=s1+":"+s2
            list_datetime.append(s3)

        i=0
        list_price=[]

        #GET PRICES OF THE CURRENCY
        for i in range (len(js_resp['prices'])):
            list_price.append(round((js_resp['prices'][i][1]),2))

        i=0
        four_list_datetime=[]
        #TO SHOW ONLY INTERVALS OF 4 ON X AXIS
        for i in range (len(js_resp['prices'])):
            if i%4==0:
                four_list_datetime.append(list_datetime[i])

        xpoints = list_datetime
        ypoints = list_price
        plt.rcParams.update({'font.size': 10})
        plt.gcf().set_size_inches(18, 5)
        plt.plot(xpoints, ypoints ,'#CC00FF',linewidth=3)
        plt.xticks(four_list_datetime,color="white",fontweight="bold",fontsize=16)
        plt.yticks(fontweight="bold",color="white",fontsize=16)
        plt.margins(x=0)
        plt.margins(y=0)
        plt.xlabel("Time",fontsize=20,color="white",fontweight="bold")
        plt.ylabel("Price",fontsize=20,color="white",fontweight="bold")
        plt.savefig('c://xampp/htdocs/ct/graphs/btc.png',bbox_inches='tight',transparent=True)
        print("BTC graph created")
        plt.close()

def graph_eth():
    resp=requests.get(url_eth)
    js_resp=resp.json()
    j=0
    # x=js_resp['prices'][2][0]
    if(resp.status_code==200):
        #CONVERT UTC TIME TO READABLE TIME
        list_timestamp=[]
        for i in range (len(js_resp['prices'])):
            list_timestamp.append(js_resp['prices'][i][0])
            list_timestamp[i]/=1000

        i=0
        list_datetime=[]
        #GET HOURS AND MINUTE FROM THE READABLE TIME
        for i in range (len(js_resp['prices'])):
            string_date=datetime.datetime.fromtimestamp(list_timestamp[i]).strftime('%Y-%m-%d %H-%M-%S')
            s1=str((datetime.datetime.strptime(string_date,"%Y-%m-%d %H-%M-%S")).hour)
            s2=str((datetime.datetime.strptime(string_date,"%Y-%m-%d %H-%M-%S")).minute)
            s3=s1+":"+s2
            list_datetime.append(s3)

        i=0
        list_price=[]

        #GET PRICES OF THE CURRENCY
        for i in range (len(js_resp['prices'])):
            list_price.append(round((js_resp['prices'][i][1]),2))

        i=0
        four_list_datetime=[]
        #TO SHOW ONLY INTERVALS OF 4 ON X AXIS
        for i in range (len(js_resp['prices'])):
            if i%4==0:
                four_list_datetime.append(list_datetime[i])


        xpoints = list_datetime
        ypoints = list_price
        plt.rcParams.update({'font.size': 10})
        plt.gcf().set_size_inches(18, 5)
        plt.plot(xpoints, ypoints ,'#CC00FF',linewidth=3)
        plt.xticks(four_list_datetime,color="white",fontweight="bold",fontsize=16)
        plt.yticks(fontweight="bold",color="white",fontsize=16)
        plt.margins(x=0)
        plt.margins(y=0)
        plt.xlabel("Time",fontsize=20,color="white",fontweight="bold")
        plt.ylabel("Price",fontsize=20,color="white",fontweight="bold")
        plt.savefig('c://xampp/htdocs/ct/graphs/eth.png',bbox_inches='tight',transparent=True)
        print("ETH graph created")
        plt.close()

def graph_bnb():
    resp=requests.get(url_bnb)
    js_resp=resp.json()
    j=0
    # x=js_resp['prices'][2][0]
    if(resp.status_code==200):
        #CONVERT UTC TIME TO READABLE TIME
        list_timestamp=[]
        for i in range (len(js_resp['prices'])):
            list_timestamp.append(js_resp['prices'][i][0])
            list_timestamp[i]/=1000

        i=0
        list_datetime=[]
        #GET HOURS AND MINUTE FROM THE READABLE TIME
        for i in range (len(js_resp['prices'])):
            string_date=datetime.datetime.fromtimestamp(list_timestamp[i]).strftime('%Y-%m-%d %H-%M-%S')
            s1=str((datetime.datetime.strptime(string_date,"%Y-%m-%d %H-%M-%S")).hour)
            s2=str((datetime.datetime.strptime(string_date,"%Y-%m-%d %H-%M-%S")).minute)
            s3=s1+":"+s2
            list_datetime.append(s3)

        i=0
        list_price=[]

        #GET PRICES OF THE CURRENCY
        for i in range (len(js_resp['prices'])):
            list_price.append(round((js_resp['prices'][i][1]),2))

        i=0
        four_list_datetime=[]
        #TO SHOW ONLY INTERVALS OF 4 ON X AXIS
        for i in range (len(js_resp['prices'])):
            if i%4==0:
                four_list_datetime.append(list_datetime[i])


        xpoints = list_datetime
        ypoints = list_price
        plt.rcParams.update({'font.size': 10})
        plt.gcf().set_size_inches(18, 5)
        plt.plot(xpoints, ypoints ,'#CC00FF',linewidth=3)
        plt.xticks(four_list_datetime,color="white",fontweight="bold",fontsize=16)
        plt.yticks(fontweight="bold",color="white",fontsize=16)
        plt.margins(x=0)
        plt.margins(y=0)
        plt.xlabel("Time",fontsize=20,color="white",fontweight="bold")
        plt.ylabel("Price",fontsize=20,color="white",fontweight="bold")
        plt.savefig('c://xampp/htdocs/ct/graphs/bnb.png',bbox_inches='tight',transparent=True)
        print("BNB graph created")
        plt.close()

def graph_doge():
    resp=requests.get(url_doge)
    js_resp=resp.json()
    j=0
    # x=js_resp['prices'][2][0]
    if(resp.status_code==200):
        #CONVERT UTC TIME TO READABLE TIME
        list_timestamp=[]
        for i in range (len(js_resp['prices'])):
            list_timestamp.append(js_resp['prices'][i][0])
            list_timestamp[i]/=1000

        i=0
        list_datetime=[]
        #GET HOURS AND MINUTE FROM THE READABLE TIME
        for i in range (len(js_resp['prices'])):
            string_date=datetime.datetime.fromtimestamp(list_timestamp[i]).strftime('%Y-%m-%d %H-%M-%S')
            s1=str((datetime.datetime.strptime(string_date,"%Y-%m-%d %H-%M-%S")).hour)
            s2=str((datetime.datetime.strptime(string_date,"%Y-%m-%d %H-%M-%S")).minute)
            s3=s1+":"+s2
            list_datetime.append(s3)

        i=0
        list_price=[]

        #GET PRICES OF THE CURRENCY
        for i in range (len(js_resp['prices'])):
            list_price.append(round((js_resp['prices'][i][1]),8))

        i=0
        four_list_datetime=[]
        #TO SHOW ONLY INTERVALS OF 4 ON X AXIS
        for i in range (len(js_resp['prices'])):
            if i%4==0:
                four_list_datetime.append(list_datetime[i])


        xpoints = list_datetime
        ypoints = list_price
        plt.rcParams.update({'font.size': 10})
        plt.gcf().set_size_inches(18, 5)
        plt.plot(xpoints, ypoints ,'#CC00FF',linewidth=3)
        plt.xticks(four_list_datetime,color="white",fontweight="bold",fontsize=16)
        plt.yticks(fontweight="bold",color="white",fontsize=16)
        plt.margins(x=0)
        plt.margins(y=0)
        plt.xlabel("Time",fontsize=20,color="white",fontweight="bold")
        plt.ylabel("Price",fontsize=20,color="white",fontweight="bold")
        plt.savefig('c://xampp/htdocs/ct/graphs/doge.png',bbox_inches='tight',transparent=True)
        print("DOGE graph created")
        plt.close()

def graph_tether():
    resp=requests.get(url_tether)
    js_resp=resp.json()
    j=0
    # x=js_resp['prices'][2][0]
    if(resp.status_code==200):
        #CONVERT UTC TIME TO READABLE TIME
        list_timestamp=[]
        for i in range (len(js_resp['prices'])):
            list_timestamp.append(js_resp['prices'][i][0])
            list_timestamp[i]/=1000

        i=0
        list_datetime=[]
        #GET HOURS AND MINUTE FROM THE READABLE TIME
        for i in range (len(js_resp['prices'])):
            string_date=datetime.datetime.fromtimestamp(list_timestamp[i]).strftime('%Y-%m-%d %H-%M-%S')
            s1=str((datetime.datetime.strptime(string_date,"%Y-%m-%d %H-%M-%S")).hour)
            s2=str((datetime.datetime.strptime(string_date,"%Y-%m-%d %H-%M-%S")).minute)
            s3=s1+":"+s2
            list_datetime.append(s3)

        i=0
        list_price=[]

        #GET PRICES OF THE CURRENCY
        for i in range (len(js_resp['prices'])):
            list_price.append(round((js_resp['prices'][i][1]),8))

        i=0
        four_list_datetime=[]
        #TO SHOW ONLY INTERVALS OF 4 ON X AXIS
        for i in range (len(js_resp['prices'])):
            if i%4==0:
                four_list_datetime.append(list_datetime[i])


        xpoints = list_datetime
        ypoints = list_price
        plt.rcParams.update({'font.size': 10})
        plt.gcf().set_size_inches(18, 5)
        plt.plot(xpoints, ypoints ,'#CC00FF',linewidth=3)
        plt.xticks(four_list_datetime,color="white",fontweight="bold",fontsize=16)
        plt.yticks(fontweight="bold",color="white",fontsize=16)
        plt.margins(x=0)
        plt.margins(y=0)
        plt.xlabel("Time",fontsize=20,color="white",fontweight="bold")
        plt.ylabel("Price",fontsize=20,color="white",fontweight="bold")
        plt.savefig('c://xampp/htdocs/ct/graphs/usdt.png',bbox_inches='tight',transparent=True)
        print("USDT graph created")
        plt.close()

graph_btc()
graph_eth()
graph_bnb()
graph_doge()
graph_tether()