-- Database: bus_db
CREATE DATABASE IF NOT EXISTS bus_db;
USE bus_db;

CREATE TABLE IF NOT EXISTS buses (
  bus_id INT AUTO_INCREMENT PRIMARY KEY,
  bus_name VARCHAR(100),
  bus_number VARCHAR(50),
  status VARCHAR(20) DEFAULT 'active'
);

CREATE TABLE IF NOT EXISTS trips (
  trip_id INT AUTO_INCREMENT PRIMARY KEY,
  bus_id INT,
  trip_name VARCHAR(150),
  route VARCHAR(200),
  start_time TIME,
  end_time TIME,
  day DATE DEFAULT CURDATE(),
  status VARCHAR(20) DEFAULT 'upcoming',
  FOREIGN KEY (bus_id) REFERENCES buses(bus_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS trip_stops (
  stop_id INT AUTO_INCREMENT PRIMARY KEY,
  trip_id INT,
  stop_order INT,
  stop_name VARCHAR(150),
  arrival_time TIME,
  FOREIGN KEY (trip_id) REFERENCES trips(trip_id) ON DELETE CASCADE
);
