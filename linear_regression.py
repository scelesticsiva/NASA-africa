from sklearn import datasets
from sklearn import linear_model
import matplotlib.pyplot as plt
import numpy as np
from numpy import genfromtxt
import csv

my_data=genfromtxt('training.csv',delimiter=',') #Getting the data from the csv file
print(my_data.shape)
X=my_data[1:1101,1:2]
print(X.shape)
for i in range(1100):
    for j in range(1):
        if(X[i][j]==np.NaN or X[i][j]==np.Infinity): #checking for any Nan or infinity in the data
            X[i][j]=0.0
y=my_data[1:1101,3599:3600]
for k in range(1100):
    for l in range(1):
        if(y[k][l]==np.NaN or y[k][l]==np.Infinity): #checking for any Nan or infinity in the data
            y[k][l]=0.0
print(y.shape)

X_test=my_data[52:71,1:2] #creating the test data
print(X_test.shape)
y_test=my_data[52:71,3599:3600]
print(y_test.shape)

#Using sk-learn to build the linear regression model
lr=linear_model.LinearRegression()
lr.fit(X,y)
print("COefficients",lr.coef_)
list_coef=lr.coef_.flatten()
sum=0

# Plotting the results
plt.scatter(X,y,color='black')
plt.plot(X,lr.predict(X),color='blue',linewidth=3)
plt.xticks(())
plt.yticks(())
plt.show()