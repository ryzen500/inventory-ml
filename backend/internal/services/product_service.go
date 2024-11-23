package services

import (
	"fmt"
	"inventory-ml/project/internal/models"
	"inventory-ml/project/internal/repository"
)

// ProductService adalah struct yang menyediakan logika bisnis untuk produk
type ProductService struct {
	Repo repository.ProductRepository // Dependency ke repository
}

// NewProductService membuat instance ProductService baru
func NewProductService(repo repository.ProductRepository) *ProductService {
	return &ProductService{Repo: repo}
}

// GetAllProducts - Mendapatkan semua produk dengan menggunakan repository
func (s *ProductService) GetAllProducts() ([]models.Product, error) {
	return s.Repo.GetAll() // Langsung panggil repository tanpa logika tambahan
}

// CreateProduct membuat produk baru setelah validasi
func (s *ProductService) CreateProduct(product models.Product) error {
	// Validasi sederhana
	if product.Name == "" {
		return fmt.Errorf("product name cannot be empty")
	}

	// Simpan ke database
	return s.Repo.Create(product)
}
