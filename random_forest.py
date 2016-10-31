from sklearn import ensemble
import matplotlib.pyplot as plt
import numpy as np
from numpy import genfromtxt
import csv

data_set=genfromtxt('training.csv',delimiter=',')
print(data_set.shape)
X=data_set[1:1001,1:2]
print(X.shape)
x_test=data_set[1002:1503,1:2]
print(x_test.shape)
y=data_set[1:1001,3599:3600]
y_test=data_set[1002:1503,3599:3600]
y_flatten=np.ravel(y)
rf=ensemble.RandomForestRegressor(1000)
rf.fit(X,y)
print((rf.predict(x_test)).shape)
print(y_test.flatten().shape)
#print(rf.score(x_test,rf.predict(x_test)))
plt.scatter(X,y_flatten,color='black')
plt.scatter(X,rf.predict(X),color='blue')

'''subtract=y_test.flatten()-rf.predict(x_test)
error=(((np.abs(subtract))**2).sum())/156
print(error)'''
sum_mean = 0
for i in range(len(rf.predict(x_test))):
    sum_mean += (rf.predict(x_test[i])-y_test[i])**2  
    #sum_error=np.sqrt(sum_mean/predict_outcome.shape[0])
print(sum_mean)
print((sum_mean/rf.predict(x_test).shape[0])**0.5)
#plt.xticks(())
#plt.yticks(())
plt.xlabel('data')
plt.ylabel('target')
plt.title('Random Forest Regression')
plt.show()
