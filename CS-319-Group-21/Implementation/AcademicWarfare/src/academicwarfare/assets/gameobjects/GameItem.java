/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package academicwarfare.assets.gameobjects;

import academicwarfare.assets.GameScene;
import academicwarfare.engine.GameObject;
import java.awt.Graphics;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;
import javax.imageio.ImageIO;

/**
 *
 * @author selin
 */
public class GameItem extends GameObject {
    String name;
    String itemImagePath;
    public GameItem( GameScene s, String name, String itemImagePath){
        super(s);
        this.name = name;
    }
    public void setImage(){
        BufferedImage img = null;
        try 
        {
            img = ImageIO.read(new File(itemImagePath));
        } 
        catch (IOException e) 
        {
            System.out.println("cannot find image file.");
            System.exit(0);
        }
        setTexture( img);
        
    }
    public void drawEntity(Graphics g){
        
       
    }
    public void setString( String label){
        
    
    }
    public String getString(){
        return null;
    }
}
