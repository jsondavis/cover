-- accounts table requires valid_jobroles table to be created first
CREATE TABLE accounts (
  user_id SERIAL PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(50) NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  highest_role INTEGER REFERENCES valid_jobroles (id),
  started_moving TIMESTAMP NOT NULL,
  created_at TIMESTAMP NOT NULL,
  last_login TIMESTAMP
);

