-- Crear tabla PRO_PROCESO
CREATE TABLE pro_proceso (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    prefijo VARCHAR(10) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Crear tabla TIP_TIPO_DOC
CREATE TABLE tip_tipo_doc (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    prefijo VARCHAR(10) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Crear tabla DOC_DOCUMENTO
CREATE TABLE doc_documento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    codigo VARCHAR(50) NOT NULL UNIQUE,
    contenido TEXT NOT NULL,
    tipo_id INT NOT NULL,
    proceso_id INT NOT NULL,
    consecutivo INT NOT NULL,

    CONSTRAINT fk_tipo FOREIGN KEY (tipo_id)
        REFERENCES tip_tipo_doc(id)
        ON DELETE RESTRICT,

    CONSTRAINT fk_proceso FOREIGN KEY (proceso_id)
        REFERENCES pro_proceso(id)
        ON DELETE RESTRICT,

    UNIQUE(tipo_id, proceso_id, consecutivo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;