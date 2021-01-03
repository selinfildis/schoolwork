import java.io.*;
import java.net.*;

/**
 * Created by Selin Fildiş & Berk Gülen
 */
public class FileDownloader {
    public static void main(String args[]) throws IOException{
        String indexFile = args[0];
        PrintWriter writer = null;
        String host = indexFile;
        String link = "";
        Socket mySocket = null;
        BufferedWriter pw1 = null;
        BufferedReader br1 = null;
        String returnMessage="";
        String trial ="";
        Socket newSocket = null;
        // Index file is the URL of the
        // index that includes a list of text file URL's

        /*
        This if checks if there is a provided lower and upper endpoint.
        If provided the program will download the bytes between these values
         */
        /*
        if(args[1]!=null) {
            args[1] = args[1].substring(1, args[1].length()-2);
            String[] endpts = args[1].split(-);
            String lowerEndpoint = endpts[0];
            String higherEndpoint = endpts[1];
        }*/
        /* Formatting the index file here */
        if(indexFile.contains("http://")){
            int count = 0;
            for(int index = 0; index < indexFile.length(); index++){

                if (indexFile.charAt(index) == '/'){
                    host = new URL(indexFile).getHost();
                    link = indexFile.replace(new URL(indexFile).getHost(), "");
                    link = link.replace("http://","");
                    break;
                }
                count++;
            }
        }
        else{

            for(int index = 0; index < indexFile.length(); index++){

                if (indexFile.charAt(index) == '/'){
                    host = indexFile.substring(0,index);
                    link = indexFile.replace(host, "");
                    break;
                }
            }
        }
        /* Opening up the socket*/
        try{
            mySocket = new Socket(InetAddress.getByName(host), 80);
            if(mySocket.isConnected()){
                System.out.println("URL of the index file: " + indexFile);
                pw1 = new BufferedWriter(new OutputStreamWriter(mySocket.getOutputStream()));
                pw1.write("GET /" + link + " HTTP/1.1\r\n");
                pw1.write("Host: " +host+"\r\n");
                pw1.write("\r\n");
                pw1.flush();
                br1 = new BufferedReader(new InputStreamReader(mySocket.getInputStream()));
                trial = br1.readLine();
                while (trial!= null) {
                    returnMessage +=trial;
                    returnMessage += "\n";
                    trial = br1.readLine();

                }
                if(returnMessage.contains("200 OK")){
                    System.out.println("Index File is downloaded");// indexFile exists!
                    String[] links = returnMessage.split("\n");
                    System.out.println("There are "+ (links.length-9) + " Files in the indexFile.");
                    for(int i = 9; i < links.length ; i++){
                        System.out.print((i-8)+". " + links[i]+"\t");
                        try{
                            /*Trying for internal files*/
                            if(links[i].contains("http://"))
                                links[i] = links[i].replace("http://","");
                                int loc = links[i].indexOf('/');
                            if (loc!=-1) {
                                host = links[i].substring(0, loc);
                                link = links[i].replace(host, "");
                            }
                            newSocket = new Socket(InetAddress.getByName(host),80);
                            BufferedWriter pw3 = new BufferedWriter(new OutputStreamWriter(newSocket.getOutputStream()));
                            pw3.write("HEAD /" + link + " HTTP/1.1\r\n");
                            pw3.write("Host: " +host+"\r\n");
                            pw3.write("\r\n");
                            pw3.flush();
                            BufferedReader br3 = new BufferedReader(new InputStreamReader(newSocket.getInputStream()));
                            String trier2 = br3.readLine();
                            String returnMessage2 = "";
                            while (trier2!= null) {
                                returnMessage2 +=trier2;
                                returnMessage2 += "\n";
                                trier2 = br3.readLine();
                            }
                            newSocket.close();
                            if(returnMessage2.contains("206 Partial Content\r\n")||returnMessage2.contains("200 OK") ){
                                newSocket = new Socket(InetAddress.getByName(host),80);
                                BufferedWriter pw2 = new BufferedWriter(new OutputStreamWriter(newSocket.getOutputStream()));
                                pw2.write("GET /" + link + " HTTP/1.1\r\n");
                                pw2.write("Host: " +host+"\r\n");
                                pw2.write("\r\n");
                                pw2.flush();
                                BufferedReader br2 = new BufferedReader(new InputStreamReader(newSocket.getInputStream()));
                                String trier3 = br2.readLine();
                                String returnMessage3 = "";
                                while (trier3!= null) {
                                    returnMessage3 +=trier3;
                                    returnMessage3 += "\n";
                                    trier3 = br2.readLine();
                                }
                                String[] content = returnMessage3.split("\n\n");
                                String[] name = link.split("/");
                                for(int k = 1; k < content.length ; k++)
                                    try{
                                        writer = new PrintWriter( name[name.length-1] , "UTF-8");
                                        writer.println(content[k]+"\n");

                                    } catch (Exception e) {
                                        // do something
                                    }
                                if(writer!=null)
                                    writer.close();
                                System.out.println("file downloaded");
                                newSocket.close();
                            }
                            else{
                                System.out.println("File does not exist");
                            }

                        }finally{
                            System.out.print("");
                        }
                    }


                }
                else{
                    System.out.println("Index File Not Found");

                }
            }
        }finally {
            System.out.print("done");
        }

    }
}
