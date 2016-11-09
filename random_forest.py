from sklearn import ensemble
import matplotlib.pyplot as plt
import numpy as np
from numpy import genfromtxt
import csv

data_set=genfromtxt('training.csv',delimiter=',')
print(data_set.shape)
X=data_set[1:1001,1200:1201]
print(X.shape)
x_test=data_set[1002:1503,1:2]
print(x_test.shape)
y=data_set[1:1001,3599:3600]
y_test=data_set[1002:1503,3599:3600]
y_flatten=np.ravel(y)
rf=ensemble.RandomForestRegressor(100)
rf.fit(X,y)
print((rf.predict(x_test)).shape)
print(y_test.flatten().shape)
#print(rf.score(x_test,rf.predict(x_test)))
plt.scatter(X,y_flatten,color='black')
plt.scatter(X,rf.predict(X),color='blue')
subtract=y_test.flatten()-rf.predict(x_test)
error=(((np.abs(subtract))**2).sum())/156
print(error)
#plt.xticks(())
#plt.yticks(())
plt.show()
