project base structur
project-root/
├── backend/                  # Service backend utama (Golang)
│   ├── cmd/                  # Entry point aplikasi
│   │   └── main.go
│   ├── config/               # Konfigurasi aplikasi (misalnya, file .env)
│   ├── internal/
│   │   ├── handlers/         # HTTP Handlers (API)
│   │   │   └── ml_handler.go # Handler untuk komunikasi dengan ML
│   │   ├── models/           # Definisi model (database)
│   │   ├── repository/       # Database access layer
│   │   ├── services/         # Service layer untuk logic bisnis
│   │   └── utils/            # Utilitas umum (misalnya, koneksi gRPC atau REST)
│   ├── proto/                # Protocol Buffers (gRPC) untuk komunikasi dengan ML service
│   ├── Dockerfile            # Dockerfile untuk backend Golang
│   └── go.mod                # Go module dependencies
│
├── ml_service/               # Service machine learning (Python)
│   ├── app/
│   │   ├── main.py           # Entry point aplikasi ML
│   │   ├── models/           # Folder untuk model ML yang disimpan atau diload
│   │   ├── services/         # Logika pemrosesan model dan inference
│   │   ├── api/              # Definisi endpoint FastAPI untuk ML service
│   ├── config/               # Konfigurasi aplikasi (file .env)
│   ├── Dockerfile            # Dockerfile untuk ml_service
│   └── requirements.txt      # Daftar pustaka Python untuk ML
│
├── docker-compose.yml        # Docker Compose untuk menjalankan kedua container bersama
├── README.md
└── .env                      # Environment variables
