import mysql.connector


class MySQL:
    def __init__(self, host, username, password, database):
        self.__params = {'host': host, 'user': username, 'password': password, 'database': database}
        self.__connection = None
        self.__errors = []

    def connect(self):
        try:
            self.__connection = mysql.connector.connect(**self.__params)
        except mysql.connector.Error as err:
            print err
            self.__errors.append(err)
            return False
        else:
            return True

    def get_connection(self):
        return self.__connection

    def get_cursor(self):
        if self.__connection is not None:
            return self.__connection.cursor()
        else:
            return None

    def disconnect(self):
        if self.__connection is not None:
            try:
                self.__connection.close()
            except mysql.connector.Error as err:
                return False, err
        else:
            return True, None

    def getErrors(self):
        return self.__errors
