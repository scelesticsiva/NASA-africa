# -*- coding: utf-8 -*-
"""
Created on Fri Oct 28 19:26:16 2016

@author: hangmengyu
"""


import numpy as np
from sklearn.svm import SVR
import matplotlib.pyplot as plt
import pandas as pd
from sklearn.cross_validation import train_test_split

def svm():
    data_1 = pd.read_csv('/Users/hangmengyu/Desktop/EC601/project/training.csv') #here ,use pandas to read cvs file.  
    data=np.array(data_1)
     #print(pd.DataFrame.apply(n,axis=0))
    print(data.shape)
    x= data[1:1101,1:2]
    '''sns.pairplot(data,x_vars=['','',''],y_vars='trainingdata',size= , aspect= )
    feature_cols=['','','']
    x = data[feature_cols]'''
    y = data[1:1101,3599:3600]
    x_train,x_test, y_train, y_test = train_test_split(x, y, random_state=1)
    svr_rbf = SVR(kernel='rbf', C= 1e3, gamma=0.1)
    svr_lin = SVR(kernel='linear')
    svr_poly = SVR(kernel='poly', degree=2)
    y_rbf = svr_rbf.fit(x_train, y_train).predict(x)
    y_lin = svr_lin.fit(x_train, y_train).predict(x)
    y_poly = svr_poly.fit(x_train, y_train).predict(x)
    lw = 2
    plt.scatter(x, y, color='darkorange', label='data')
    plt.hold('on')
    plt.plot(x, y_rbf, color='navy', lw=lw, label='RBF model')
    plt.plot(x, y_lin, color='c', lw=lw, label='Linear model')
    plt.plot(x, y_poly, color='cornflowerblue', lw=lw, label='Polynomial model')
    plt.xlabel('data')
    plt.ylabel('target')
    plt.title('Support Vector Regression')
    plt.legend()
    plt.show()
    
svm()
