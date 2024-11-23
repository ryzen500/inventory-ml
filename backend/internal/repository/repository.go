package repository

import (
	"database/sql"
	"inventory-ml/project/internal/models"
)

// ProductRepository - Interface untuk repository produk
type ProductRepository interface {
	GetAll() ([]models.Product, error)
	Create(product models.Product) error
}

// ProductRepository - Struct untuk mengakses data produk di database
type ProductRepositorys struct {
	DB *sql.DB
}

// ProductRepositoryImpl adalah implementasi dari ProductRepository
type ProductRepositoryImpl struct {
	DB *sql.DB
}

// NewProductRepository mengembalikan instance dari ProductRepositoryImpl
func NewProductRepository(db *sql.DB) ProductRepository {
	return &ProductRepositoryImpl{DB: db}
}

// NewProductRepository mengembalikan instance dari ProductRepositoryImpl
func NewInventoryRepository(db *sql.DB) ProductRepository {
	return &ProductRepositoryImpl{DB: db}
}

// Implementasi metode GetAll untuk ProductRepository
func (r *ProductRepositoryImpl) GetAll() ([]models.Product, error) {
	// Query produk dari database
	rows, err := r.DB.Query("SELECT id, name, sku, category, weight, dimensions FROM products")
	if err != nil {
		return nil, err
	}
	defer rows.Close()

	var products []models.Product
	for rows.Next() {
		var product models.Product
		err := rows.Scan(&product.ID, &product.Name, &product.SKU, &product.Category, &product.Weight, &product.Dimensions)
		if err != nil {
			return nil, err
		}
		products = append(products, product)
	}
	return products, nil
}

// GetAll - Fungsi untuk mengambil semua produk dari database
func (r *ProductRepositorys) GetAll() ([]models.Product, error) {
	rows, err := r.DB.Query("SELECT id, name, sku, category, weight, dimensions FROM products")
	if err != nil {
		return nil, err
	}
	defer rows.Close()

	var products []models.Product
	for rows.Next() {
		var product models.Product
		// var createdAt, updatedAt sql.NullTime // menggunakan sql.NullTime untuk menangani NULL

		err := rows.Scan(
			&product.ID, &product.Name, &product.SKU, &product.Category,
			&product.Weight, &product.Dimensions,
		)
		if err != nil {
			return nil, err
		}

		// Jika kolom created_at dan updated_at berisi nilai yang valid (bukan NULL)
		// if createdAt.Valid {
		// 	product.CreatedAt = createdAt.Time
		// }
		// if updatedAt.Valid {
		// 	product.UpdatedAt = updatedAt.Time
		// }

		products = append(products, product)
	}
	return products, nil
}

// Implementasi metode Create untuk ProductRepository
func (r *ProductRepositoryImpl) Create(product models.Product) error {
	_, err := r.DB.Exec(`
		INSERT INTO products (id, name, sku, category, weight, dimensions, created_at, updated_at) 
		VALUES ($1, $2, $3, $4, $5, $6, $7, $8)`,
		product.ID, product.Name, product.SKU, product.Category, product.Weight, product.Dimensions,
	)
	return err
}
