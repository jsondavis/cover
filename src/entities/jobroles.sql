-- jobroles to be used in accounts
CREATE TABLE valid_jobroles (
  id SERIAL PRIMARY KEY NOT NULL,
  jobrole varchar(50)
);

INSERT INTO valid_jobroles (jobrole) VALUES 
  ('mover helper'),
  ('mover'),
  ('packer'),
  ('driver'),
  ('crew leader')
;
