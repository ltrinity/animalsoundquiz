CREATE TABLE IF NOT EXISTS tblUsers(
pmkUserId int(11) NOT NULL AUTO_INCREMENT,
fldFirstName varchar(15) NOT NULL,
fldLastName varchar(15) NOT NULL,
fnkFavoriteAnimalName varchar(15) NOT NULL,
fldEmail varchar(20) NOT NULL,
fldDateJoined varchar(20) NOT NULL,
fldLevel int(1) NOT NULL DEFAULT '1',
PRIMARY KEY (pmkUserId))

CREATE TABLE IF NOT EXISTS tblUsersQuizzes(
fnkUserId int(11) NOT NULL,
fnkQuizId int(11) NOT NULL,
fldNumberCorrect int(3) NOT NULL DEFAULT '0',
fldTotalQuestions int(3) NOT NULL,
CONSTRAINT pmkUsersQuizzesId PRIMARY KEY(fnkUserId,fnkQuizId))

CREATE TABLE IF NOT EXISTS tblQuizzes(
pmkQuizId int(11) NOT NULL AUTO_INCREMENT,
fldDateCreated varchar(20) NOT NULL,
fldQuizName varchar(20) NULL,
PRIMARY KEY (pmkQuizId))

CREATE TABLE IF NOT EXISTS tblQuizzesQuestions(
fnkQuizId int(11) NOT NULL,
fnkQuestionId int(11) NOT NULL,
fnkUserChoseAnimalName varchar(15) NOT NULL,
fldTimeToAnswer int(11) NOT NULL,
CONSTRAINT pmkQuizzesQuestionsId PRIMARY KEY(fnkQuizId,fnkQuestionId))

CREATE TABLE IF NOT EXISTS tblQuestions(
pmkQuestionId int(11) NOT NULL AUTO_INCREMENT,
fnkRightAnswerAnimalId varchar(15) NOT NULL,
PRIMARY KEY (pmkQuestionId))

CREATE TABLE IF NOT EXISTS tblQuestionsAnimals(
fnkQuestionId int(11) NOT NULL,
fnkAnimalName varchar(15) NOT NULL,
CONSTRAINT pmkQuestionsAnimalsId PRIMARY KEY(fnkQuestionId,fnkAnimalName))

CREATE TABLE IF NOT EXISTS tblAnimals(
pmkAnimalName varchar(15) NOT NULL,
fldAnimalPhoto varchar(15) NOT NULL,
fldLinkFurtherInfo varchar(30) NOT NULL,
PRIMARY KEY (pmkAnimalName))

CREATE TABLE IF NOT EXISTS tblSounds(
fnkAnimalName varchar(15) NOT NULL,
fldSoundName varchar(15) NOT NULL,
fldDifficulty int(2) NOT NULL,
CONSTRAINT pmkSoundId PRIMARY KEY(fnkAnimalName,fldSoundName))

CREATE TABLE IF NOT EXISTS tblAnimalsAnimals(
fnkFirstAnimalName varchar(15) NOT NULL,
fnkSecondAnimalName varchar(15) NOT NULL,
fldDifficulty int(2) NOT NULL,
CONSTRANT pmkAnimalAnimalId PRIMARY KEY (fnkFirstAnimalName,fnkSecondAnimalName,fldDifficulty)
)

