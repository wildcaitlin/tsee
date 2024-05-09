To run the booking system, the config file needs to connect to a created database.
A table can be created like this for example:
create table if not exists bookings (
    -- bookingid int primary key auto_increment,
    -- firstname varchar(20),
    -- surname varchar(20),
    name varchar(20),
    datetime datetime not null unique,
    date date,
    time time,
    email varchar(50)
    -- code varchar(10) -- depends on how api works. not null, code saved here
);

CREATE TRIGGER before_insert_bookings
BEFORE INSERT ON bookings
FOR EACH ROW
SET NEW.date = DATE(NEW.datetime),
    NEW.time = TIME(NEW.datetime);


insert into bookings(datetime) values
('2024-02-15 10:30'),
('2024-02-17 13:15'),
('2024-02-17 19:30'),
('2024-02-19 12:00'),
('2024-02-14 14:00'),
('2024-02-19 17:45'),
('2024-02-20 09:00'),
('2024-02-13 12:45'),
('2024-02-13 08:30'),
('2024-02-16 11:45'),
('2024-02-15 16:20'),
('2024-02-16 18:00'),
('2024-02-14 09:15'),
('2024-02-18 08:45'),
('2024-02-18 14:30');

select * from bookings;
select * from bookings where name is null;

The automatic email system requires connecting to an actual email to send from.
