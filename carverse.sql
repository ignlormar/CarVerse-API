-- Crear base de datos
DROP DATABASE carverse;
CREATE DATABASE carverse;

-- Usar la base de datos
USE carverse;

-- Tabla usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    telefono VARCHAR(20),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla dispositivos
CREATE TABLE dispositivos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    imei VARCHAR(50) UNIQUE NOT NULL,
    flespi_id BIGINT UNIQUE NOT NULL,
    descripcion TEXT,
    fecha_alta DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla vehiculos
CREATE TABLE vehiculos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    foto TEXT,
    marca VARCHAR(100) NOT NULL,
    modelo VARCHAR(100) NOT NULL,
    matricula VARCHAR(20) UNIQUE NOT NULL,
    anio_matriculacion INT,
    combustible VARCHAR(50),
    km INT DEFAULT 0,
    proximo_mantenimiento INT,
    fecha_itv DATE,
    dispositivo_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (dispositivo_id) REFERENCES dispositivos(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla viajes
CREATE TABLE viajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehiculo_id INT NOT NULL,
    dispositivo_id INT NOT NULL,
    start_ts DATETIME NOT NULL,
    end_ts DATETIME NOT NULL,
    duracion_s INT NOT NULL,
    distancia_m INT NOT NULL,
    start_lat DOUBLE NOT NULL,
    start_lon DOUBLE NOT NULL,
    end_lat DOUBLE NOT NULL,
    end_lon DOUBLE NOT NULL,
    max_speed_kph DOUBLE,
    avg_speed_kph DOUBLE,
    route_polyline TEXT,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (vehiculo_id) REFERENCES vehiculos(id) ON DELETE CASCADE,
    FOREIGN KEY (dispositivo_id) REFERENCES dispositivos(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE configuracion_usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    tema VARCHAR(20) DEFAULT 'claro', -- 'claro', 'oscuro', 'dispositivo'
    idioma VARCHAR(10) DEFAULT 'es', -- 'es', 'en', 'fr'
    unidades VARCHAR(20) DEFAULT 'metrico', -- 'metrico', 'imperial'
    -- Notificaciones (Firebase)
    firebase_token TEXT, -- Token de Firebase Cloud Messaging
    notif_movimiento_activada BOOLEAN DEFAULT TRUE,
    notif_itv_activada BOOLEAN DEFAULT TRUE,
    notif_itv_dias_antelacion INT DEFAULT 30,
    notif_mantenimiento_activada BOOLEAN DEFAULT TRUE,
    notif_mantenimiento_km_antelacion INT DEFAULT 500,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    UNIQUE KEY unique_usuario_config (usuario_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Índices adicionales para mejorar rendimiento
CREATE INDEX idx_vehiculos_usuario_id ON vehiculos(usuario_id);
CREATE INDEX idx_vehiculos_dispositivo_id ON vehiculos(dispositivo_id);
CREATE INDEX idx_viajes_vehiculo_id ON viajes(vehiculo_id);
CREATE INDEX idx_viajes_dispositivo_id ON viajes(dispositivo_id);
CREATE INDEX idx_viajes_start_ts ON viajes(start_ts);
CREATE INDEX idx_viajes_end_ts ON viajes(end_ts);
CREATE INDEX idx_config_usuario_id ON configuracion_usuario(usuario_id);