
from flask import Flask, request, jsonify
import joblib
import numpy as np
import pickle
import os

app = Flask(__name__)
model = joblib.load("prediction.pkl")



@app.route('/predict', methods=['POST','GET'])
def predict():
#     Récupérer les données envoyées par le client
    data = request.get_json()

#     # Extraire les valeurs des features nécessaires pour la prédiction
    feature1 = data['Coefficient']
    feature2 = data['Age']
#

    test = np.array([[feature1, feature2]])
    prediction = model.predict(test)

# # Convert the prediction to a regular Python int
    prediction = prediction.item()

     # Return the prediction as the response
    response = {'prediction': prediction}
    return jsonify(response)


if __name__ == '__main__':
    app.run(debug=True)

