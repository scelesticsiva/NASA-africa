import mysql.connector
from numpy import random

number_of_entries=150 #Enter a multiple of 15

cn=mysql.connector.connect(user='root',password='password',database='Geo_data')
cur=cn.cursor()
count=0;
address_string="Soil data for EC601"
type_string="NASA/Africa"
for_range=number_of_entries//15

lat_lon_dict={1:[10,30,-10,30],2:[-10,10,15,35],3:[-30,-10,20,30]}
string_list=["maize","rice","soybean","wheat","potato"]

for value in lat_lon_dict.values():
    for element in string_list:
        for i in range(0,for_range):
            lat=round(random.uniform(value[0],value[1]),6)
            lng=round(random.uniform(value[2],value[3]),6)
            count=count+1
            cur.execute('''INSERT INTO markers (id,name,address,lat,lng,type) VALUES (%s,%s,%s,%s,%s,%s)''',(count,element,address_string,lat,lng,type_string))
            #print(lat," ",lng," ",element)

cn.commit()
cur.close()
cn.close()
