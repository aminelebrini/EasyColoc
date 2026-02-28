CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(255) NOT NULL,
    reputation INT DEFAULT 0,
    is_banned BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE colocations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    status ENUM('active','cancelled') NOT NULL,
    numbers INT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    colocation_id INT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (colocation_id)
        REFERENCES colocations(id)
        ON DELETE CASCADE
);

CREATE TABLE memberships (
    id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT NOT NULL,
    colocation_id INT NOT NULL,
    role VARCHAR(255) NOT NULL,
    joined_at DATE NOT NULL,
    left_at DATE NULL,
    FOREIGN KEY (member_id)
        REFERENCES users(id)
        ON DELETE CASCADE,
    FOREIGN KEY (colocation_id)
        REFERENCES colocations(id)
        ON DELETE CASCADE
);

CREATE TABLE invitations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    token VARCHAR(255) NOT NULL UNIQUE,
    status ENUM('pending','accepted','refused') NOT NULL,
    colocation_id INT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (colocation_id)
        REFERENCES colocations(id)
        ON DELETE CASCADE
);

CREATE TABLE expenses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    amount DECIMAL(10,2) NOT NULL,
    description TEXT NOT NULL,
    user_id INT NOT NULL,
    colocation_id INT NOT NULL,
    category_id INT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE,
    FOREIGN KEY (colocation_id)
        REFERENCES colocations(id)
        ON DELETE CASCADE,
    FOREIGN KEY (category_id)
        REFERENCES categories(id)
        ON DELETE CASCADE
);

CREATE TABLE settlements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    amount DECIMAL(10,2) NOT NULL,
    is_paid BOOLEAN DEFAULT FALSE,
    debtor_id INT NOT NULL,
    creditor_id INT NOT NULL,
    expense_id INT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (debtor_id)
        REFERENCES users(id)
        ON DELETE CASCADE,
    FOREIGN KEY (creditor_id)
        REFERENCES users(id)
        ON DELETE CASCADE,
    FOREIGN KEY (expense_id)
        REFERENCES expenses(id)
        ON DELETE CASCADE
);