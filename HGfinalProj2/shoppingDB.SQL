CREATE TABLE Users(
	FName	        VARCHAR(25) NOT NULL,
    LName	        VARCHAR(25) NOT NULL,
	Email			VARCHAR(50) NOT NULL,
	username		VARCHAR(11) NOT NULL,
	UPassword	    VARCHAR(255) NOT NULL,
	PRIMARY KEY (email)
	);



INSERT INTO users VALUES ("Hannah", "George", "emiemie3e@gmailcom", "haneligeo99", "123Website");

CREATE TABLE shoppingList(
	itemNo          DECIMAL(15) NOT NULL,
    item	        VARCHAR(25) NOT NULL,
	price           DECIMAL(10, 2) NOT NULL,
	IDescription	VARCHAR(255) NOT NULL,
	image_path		VARCHAR(30) NOT NULL,
	PRIMARY KEY (itemNo)
	);

INSERT INTO shoppingList VALUES
("001","Skittles", "2.00", "Try the Rainbow, Taste the Rainbow!", "skittles.png"),
("002", "Jolly Rancher", "0.50", "A hard candy with both fruit flavors and sour mixed together including Wild Strawberry, Green Apple, Watermelon, Cherry and Blue Raspberry.", "jolly.png"),
("003", "Sour Patch Kids", "3.50", 'Sour - Sweet - Gone!  tasty soft gummy candy with a coating of sour sugar, so the taste of the candy changes from sour to sweet', "sour.png");
