//Create USER TABLE
create table user ( UniqueId varchar(20) NOT NULL UNIQUE, FirstName varchar(35) NOT NULL, LastName varchar(35), NickName varchar(35), Active varchar(5) NOT NULL DEFAULT 'true' );

//Create SHIFT TABLE
create table shift (ShiftId INT NOT NULL AUTO_INCREMENT PRIMARY_KEY, ShiftFrom varchar(20) NOT NULL, ShiftTo varchar(20) NOT NULL, NumberOfCandidates INT, Active varchar(5) NOT NULL DEFAULT 'true' );

//Create ShiftsAvailable Table
create table shifts_available (YearWeekDay varchar(16) NOT NULL UNIQUE, Shift1 varchar(20), Shift2 varchar(20), Shift3 varchar(20), Shift4 varchar(20));



create table user_shifts ( UserUniqueId varchar(20) NOT NULL, ShiftIds varchar(100), YearWeekDay varchar(20), YearWeek varchar(16))