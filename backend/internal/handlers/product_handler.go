package handlers

import (
	"encoding/json"
	"net/http"

	"inventory-ml/project/internal/models"
	"inventory-ml/project/internal/services"

	"github.com/google/uuid"
)

func GetProducts(w http.ResponseWriter, r *http.Request) {
	products, err := services.GetAllProducts()
	if err != nil {
		http.Error(w, err.Error(), http.StatusInternalServerError)
		return
	}
	json.NewEncoder(w).Encode(products)
}

func CreateProduct(w http.ResponseWriter, r *http.Request) {
	var product models.Product
	err := json.NewDecoder(r.Body).Decode(&product)
	if err != nil {
		http.Error(w, "Invalid input", http.StatusBadRequest)
		return
	}

	// Generate UUID untuk ID produk
	product.ID = uuid.New().String()

	err = services.CreateProduct(product)
	if err != nil {
		http.Error(w, err.Error(), http.StatusInternalServerError)
		return
	}

	w.WriteHeader(http.StatusCreated)
	json.NewEncoder(w).Encode(map[string]string{"message": "Product created", "id": product.ID})
}
