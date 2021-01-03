/**
 * Created by Selin on 1.12.2016.
 */

import java.lang.Class;
import java.lang.ClassNotFoundException;
import java.lang.String;
import java.sql.*;

public class Database {
    public static void main(String[] args) throws SQLException, ClassNotFoundException, IllegalAccessException, InstantiationException {
        Connection conn = null;
        Statement stmt = null;
        String sql = "";
        try{
            Class.forName("com.mysql.jdbc.Driver").newInstance();
        }catch(Exception ex){
            System.out.print("Driver ERROR");
        }finally {
            try {
                conn = DriverManager.getConnection("jdbc:mysql://dijkstra2.ug.bcc.bilkent.edu.tr/selin_fildis","selin.fildis","f1kjhn7y");
                stmt = conn.createStatement();
               System.out.println("Deleting tables if exists...");

                stmt.execute("SET FOREIGN_KEY_CHECKS = 0;");

                sql = "DROP TABLE if EXISTS Shows;";
                stmt = conn.createStatement();
                stmt.executeUpdate(sql);
                sql = "DROP TABLE IF EXISTS guest_show ;";
                stmt = conn.createStatement();
                stmt.executeUpdate(sql);
                sql = "DROP TABLE IF EXISTS Host; ";
                stmt = conn.createStatement();
                stmt.executeUpdate(sql);
                sql = "DROP TABLE if EXISTS Guest; ";
                stmt = conn.createStatement();
                stmt.executeUpdate(sql);
                sql = "DROP TABLE if EXISTS Channel; ";
                stmt = conn.createStatement();
                stmt.executeUpdate(sql);
                System.out.println("Creating Tables....");
                sql = "CREATE TABLE Host (hid INTEGER, " +
                        "name VARCHAR(50)," +
                        "nickname VARCHAR(50)," +
                        "password VARCHAR(50)," +
                        "title VARCHAR(50)," +
                        "profession VARCHAR(50)," +
                        "PRIMARY KEY (hid)) ENGINE=InnoDB;";
                Statement st = conn.createStatement();
                st.executeUpdate(sql);
                sql = "CREATE TABLE Channel (cid INTEGER, " +
                        "cname VARCHAR(50)," +
                        "PRIMARY KEY (cid)" +
                        ")ENGINE=InnoDB;";
                st = conn.createStatement();
                st.executeUpdate(sql);
                sql = "CREATE TABLE Shows (sid INTEGER, " +
                        "pname VARCHAR(50)," +
                        "time TIME," +
                        "day VARCHAR(50)," +
                        "hid INTEGER," +
                        "cid INTEGER," +
                        "PRIMARY KEY (sid)," +
                        "FOREIGN KEY (hid) REFERENCES Host(hid)," +
                        "FOREIGN KEY (cid) REFERENCES Channel(cid)" +
                        ")ENGINE=InnoDB;";
                st = conn.createStatement();
                st.executeUpdate(sql);
                sql = "CREATE TABLE Guest (gid INTEGER, " +
                        "gname VARCHAR(50)," +
                        "title VARCHAR(50)," +
                        "profession VARCHAR(50)," +
                        "short_bio VARCHAR(1000)," +
                        "PRIMARY KEY (gid))" +
                        "ENGINE=InnoDB;";
                st = conn.createStatement();
                st.executeUpdate(sql);
                sql = "CREATE TABLE guest_show " +
                        "(sid INTEGER, " +
                        "gid INTEGER," +
                        "dates DATE," +
                        "PRIMARY KEY (gid)," +
                        "FOREIGN KEY (sid) REFERENCES  Shows(sid)" +
                        ")ENGINE=InnoDB;";
                st = conn.createStatement();
                st.executeUpdate(sql);
                System.out.println("Inserting to tables....");
                sql = "INSERT INTO Host VALUES ( 1, 'Fatih Altayli', 'altayli','1111','Mr.', 'Journalist');";

                st.executeUpdate(sql);
                sql = "INSERT INTO Host VALUES (2, 'Cuneyt Ozdemir', 'ozdemir','2222','Mr.', 'Journalist');";

                st.executeUpdate(sql);
                sql = "INSERT INTO Host " +
                        "VALUES (3, 'Neil deGrasse Tyson'," +
                        " 'tyson','3333','Dr.', 'Astrophysicist');";

                st.executeUpdate(sql);
                sql = "INSERT INTO Channel " +
                        "VALUES (1, 'National Geographic');";
                st = conn.createStatement();
                st.executeUpdate(sql);
                sql = "INSERT INTO Channel " +
                        "VALUES (2, 'CNN TURK')";

                st.executeUpdate(sql);
                sql = "INSERT INTO Channel " +
                        "VALUES (3, 'Haberturk')";

                st.executeUpdate(sql);
                sql = "INSERT INTO Shows " +
                        "VALUES (1, 'Teke Tek', '23:00:00', 'Tuesday', 1,3)";
                st = conn.createStatement();
                st.executeUpdate(sql);
                sql = "INSERT INTO Shows " +
                        "VALUES (2, '5N1K', '22:00:00', 'Sunday', 2,2)";
                st = conn.createStatement();
                st.executeUpdate(sql);
                sql = "INSERT INTO Shows " +
                        "VALUES (3, 'Startalk', '22:00:00', 'Monday', 3,1)";
                st = conn.createStatement();
                st.executeUpdate(sql);
                sql = "INSERT INTO Guest " +
                        "VALUES (5, 'Celal Sengor', 'Prof. Dr.', 'Geologist'," +
                        " 'Professor Sengor is a foreign member of\n" +
                        "The American Philosophical Society, The United\n" +
                        "States national Academy of Sciences and\n" +
                        "The Russian Academy of Sciences. Actually, he\n" +
                        "is the second Turkish prominent professor who\n" +
                        "is elected as a member by the Russian\n" +
                        "Academy of Sciences after Professor\n" +
                        "ordinarius Mehmet Fuat Koprulu')";
                st = conn.createStatement();
                st.executeUpdate(sql);
                sql = "INSERT INTO Guest " +
                        "VALUES (6, 'Ilber Ortayli', 'Prof. Dr.', 'Historian'," +
                        "'İlber Ortayli is heir to a bilingual Turkish family\n" +
                        "so that he obtained German from his father AND\n" +
                        "Russian from his mother. As a polyglot historian\n" +
                        "he has enough competency in Italian, English,\n" +
                        "French, Persian and also in Ottoman Turkish\n" +
                        "and Latin in order to fluently employ or maintain\n" +
                        "historical research with historical documents IN\n" +
                        "the archives. His published articles are mainly IN\n" +
                        "Turkish, German and French and various of\n" +
                        "them are translated in English.\n')";
                st = conn.createStatement();
                st.executeUpdate(sql);
                sql = "INSERT INTO Guest VALUES (7, 'Mayim Bialik', 'Mrs.', 'Actress',"+
                        "'Mayim Chaya Bialik is an American actress AND\n" +
                        "neuroscientist. from 1991 TO 1995, she played\n" +
                        "the title character of NBC''s Blossom. Since\n" +
                        "2010, she has played Dr. Amy Farrah Fowler \n" +
                        "like the actress, a neuroscientist on CBS''s The Big Bang Theory.\n'" +
                        ")";
                st = conn.createStatement();
                st.executeUpdate(sql);
                sql = "INSERT INTO Guest " +
                        "VALUES (8, 'Orhan Pamuk', 'Mr.', 'Novelist'," +
                        "'Orhan Pamuk is a Turkish novelist,\n" +
                        "screenwriter, academic and recipient of the\n" +
                        "2006 Nobel Prize in Literature. one of Turkey''s\n" +
                        "most prominent novelists, his work has sold\n" +
                        "over thirteen million books in sixty-three\n" +
                        "languages, making him the country''s bestselling\n" +
                        "writer.')";
                st = conn.createStatement();
                st.executeUpdate(sql);
                sql = "INSERT INTO Guest " +
                        "VALUES (9, 'Fazil Say', 'Mr.','Pianist'," +
                        "'Fazil Say is a virtuoso Turkish pianist and\n" +
                        "composer who was born IN Ankara, described\n" +
                        "recently as \"not merely a pianist of genius; but\n" +
                        "undoubtedly he will be one of the great artists of\n" +
                        "the twenty-first century\".')";
                st = conn.createStatement();
                st.executeUpdate(sql);
                sql = "INSERT INTO guest_show " +
                        "VALUES (1,5,'2016-11-22')";
                st = conn.createStatement();
                st.executeUpdate(sql);
                sql = "INSERT INTO guest_show" +
                        " VALUES (1,6,'2016-11-22')";
                st = conn.createStatement();
                st.executeUpdate(sql);
                sql = "INSERT INTO guest_show" +
                        " VALUES (3,7,'2016-11-21')";
                st = conn.createStatement();
                st.executeUpdate(sql);
                sql = "INSERT INTO guest_show" +
                        " VALUES (2,8,'2016-11-27')";
                st = conn.createStatement();
                st.executeUpdate(sql);
                sql = "INSERT INTO guest_show" +
                        " VALUES (2,9,'2016-11-27')";
                st = conn.createStatement();
                st.executeUpdate(sql);
                System.out.println("Host");

                sql = "SELECT Host.hid, Host.name, Host.nickname, Host.password, Host.title, Host.profession FROM Host";
                st = conn.createStatement();
                ResultSet rs = st.executeQuery(sql);
                while (rs.next()) {
                    System.out.println(rs.getInt("hid") + "\t"
                            + rs.getString("name") + "\t"
                            + rs.getString("nickname") + "\t"
                            + rs.getString("password") + "\t"
                            + rs.getString("title") + "\t"
                            + rs.getString("profession"));
                }
                System.out.println("Channel");
                sql = "SELECT Channel.cid, Channel.cname FROM Channel";
                st = conn.createStatement();
                rs = st.executeQuery(sql);
                while (rs.next()) {
                    System.out.println(rs.getInt("cid") + "\t"
                            + rs.getString("cname"));
                }
                System.out.println("Shows");
                sql = "SELECT Shows.sid, Shows.pname,Shows.time, Shows.day, Shows.hid, Shows.cid FROM Shows";
                st = conn.createStatement();
                rs = st.executeQuery(sql);
                while (rs.next()) {
                    System.out.println(rs.getInt("sid") + "\t"
                            + rs.getString("pname") + "\t"
                            + rs.getString("time") + "\t"
                            + rs.getString("day") + "\t"
                            + rs.getInt("hid")+"\t"
                            + rs.getInt("cid"));
                }
                System.out.println("Guest");
                sql = "SELECT Guest.gid, Guest.gname, Guest.title, Guest.profession," +
                        "Guest.short_bio FROM Guest";
                st = conn.createStatement();
                rs = st.executeQuery(sql);
                while (rs.next()) {
                    System.out.println(rs.getInt("gid") + "\t"
                            + rs.getString("gname") + "\t"
                            + rs.getString("profession") + "\n"
                            + rs.getString("short_bio"));
                }
                System.out.println("Guest_Show");
                sql = "SELECT guest_show.gid, guest_show.sid," +
                        "guest_show.dates FROM guest_show";
                st = conn.createStatement();
                rs = st.executeQuery(sql);
                while (rs.next()) {
                    System.out.println(rs.getInt("sid") + "\t"
                            + rs.getString("gid") + "\t"
                            + rs.getString("dates"));
                }

            } catch (SQLException ex) {
                // handle any errors
                System.out.println("SQLException: " + ex.getMessage());
                ex.printStackTrace();
                System.out.println("SQLState: " + ex.getSQLState());
                System.out.println("VendorError: " + ex.getErrorCode());
            }finally {

            }
        }

    }
}