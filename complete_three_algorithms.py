#AUTHOR Sivaramakrishnan Sankarapandian sivark@bu.edu
#AUTHOR Meng Yu myhang@bu.edu
#AUTHOR Ruilong lyn ruilong@bu.edu
#AUTHOR Yichen yq24@bu.edu
#AUTHOR Fan cao fanc@bu.edu

from sklearn import linear_model,ensemble
from sklearn.svm import SVR
import numpy as np
from numpy import genfromtxt

def linear_regression(X,y,X_test):
    """Builds a linear regression model from the train data"""
    lr=linear_model.LinearRegression()
    lr.fit(X,y)
    predicted_values = lr.predict(X_test) #Retrieving the predicted values for the test data
    predict_values_min = predicted_values.min()
    predict_values_max = predicted_values.max()
    predict_values_min = round(predict_values_min,4) #Picking up the maximum and minimum values to determine the range of the values for each of the soil property
    predict_values_max = round(predict_values_max,4)
    return (predict_values_min,predict_values_max) #Returning the maximum and minimum values as a tuple

def random_forest(X,y,X_test):
    """Builds a random forest regressor from the train data"""
    rf=ensemble.RandomForestRegressor(n_estimators=10,max_depth=10)
    rf.fit(X,np.ravel(y))
    predicted_values = rf.predict(X_test) #retrieving the predicted values from the random forest model
    predict_values_min = predicted_values.min()
    predict_values_max = predicted_values.max()
    predict_values_min = round(predict_values_min,4) #Picking the maximum and minimum values to determine the range of the values for each of the soil property
    predict_values_max = round(predict_values_max,4)
    return (predict_values_min,predict_values_max) #Returning the maximum and minimum values as a tuple
    
def svm(X,y,X_test):
    """Builds a support vector machine from the train data"""
    svr_rbf = SVR(kernel='rbf', C= 1e3, gamma=0.1) #declaring a Gaussian kernel for the support vector machine
    svr_lin = SVR(kernel='linear') #decalring a linear kernel for the support vector machine
    y_rbf = svr_rbf.fit(X, np.ravel(y)).predict(X_test) #fitting the train data to a radial basis kernel
    y_lin = svr_lin.fit(X, np.ravel(y)).predict(X_test) #fitting the train data to a linear model
    return(y_rbf.min(),y_rbf.max()) #returning the maximum and minimum values as a tuple

def main():
    my_data=genfromtxt('training.csv',delimiter=',')  #Getting the train data
    X=my_data[1:1001,1:1001] #Seperating the features used for training
    X_test=my_data[1002:1101,1:1001]
    for i in range(5): #To loop through all the five soil properties
        initial=i+3595
        y=my_data[1:1001,initial:(initial+1)]
        y_test=my_data[1002:1101,initial:(initial+1)]
        print(y_test.min(),y_test.max())
        print(svm(X,y,X_test))
        print(random_forest(X,y,X_test))
        print(linear_regression(X,y,X_test))
        
if __name__=='__main__':
    main()
    

    
