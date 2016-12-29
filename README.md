# African soil properties

The goal of this project is to develop a website(with Google maps API) for farmers to enable them to choose the crops depending on the soil properties in the area they are living in. 

The dataset from kaggle competition of african soil prediction was used to build machine learning models which formed the back end of our website.

We used scikit-learn to build our machine learning models and the ML algorithms used were,

- Linear Regression
- Random Forest Regression
- Support Vector Machines(using polynomial and radial basis function kernels)

The predictions of ML models were loaded onto mysql databases which was connected to the front end of the website through xml and javascript.

Every time, the farmer enters a crop in the search bar, the particular crop locations are retrieved from the database and the xml file is updated. Javascript which forms the front end of the website reads the xml file to display the corresponding locations in Google maps.

Since the dataset we used only had five soil properties, our machine learning code was essentially limited to predicting those five features of the soil, however our python code is extendible to any number of features. This complete code can be found in complete_three_algorithms.py

The whole website is in the website folder.

##  Dependencies

- Numpy
- Scikit-learn
- apache server
- php
- mysql

To setup apache server,php,mysql database in a mac machine, here is the link,
```
https://www.youtube.com/watch?v=b_6g_5S_bVo
```


