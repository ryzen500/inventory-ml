package models

type Product struct {
	ID         string  `json:"id"`         // UUID
	Name       string  `json:"name"`       // Nama produk
	SKU        string  `json:"sku"`        // Kode unik produk
	Category   string  `json:"category"`   // Kategori produk
	Weight     float64 `json:"weight"`     // Berat produk
	Dimensions string  `json:"dimensions"` // Dimensi produk (panjang x lebar x tinggi)
	// CreatedAt  time.Time `json:"created_at"` // Waktu pembuatan
	// UpdatedAt  time.Time `json:"updated_at"` // Waktu pembaruan terakhir
}
