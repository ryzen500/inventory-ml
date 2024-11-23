package main

import (
	"inventory-ml/project/internal/repository"
	"inventory-ml/project/internal/services"
	"inventory-ml/project/internal/utils"
	"log"
	"net/http"
)

func main() {
	// Connect to DB
	db := utils.ConnectDB() // Assuming you have a DB connection utility function
	defer db.Close()

	// Initialize the product repository
	productRepo := repository.NewProductRepository(db)

	// Initialize the inventory repository
	// inventoryRepo := repository.NewInventoryRepository(db)

	// Initialize services
	productService := services.NewProductService(productRepo)
	// inventoryService := services.NewInventoryService(inventoryRepo)

	// Example usage of services
	// Get all products using productService
	products, err := productService.GetAllProducts()
	if err != nil {
		log.Fatalf("Error fetching products: %v", err)
	}

	log.Println("Products fetched successfully:")
	for _, product := range products {
		log.Printf("ID: %s, Name: %s, SKU: %s", product.ID, product.Name, product.SKU)
	}

	// Example usage of inventoryService to add stock
	// err = inventoryService.AddStock("some-product-id", 10)
	// if err != nil {
	// 	log.Fatalf("Error adding stock: %v", err)
	// }

	// log.Println("Stock added successfully.")

	// Your server code (if any) here. For example:
	http.ListenAndServe(":8080", nil) // Start your web server here if needed.
}
