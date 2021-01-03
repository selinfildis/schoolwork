/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package academicwarfare.assets.gameobjects;

import academicwarfare.assets.GameScene;
import academicwarfare.engine.GameObject;
import academicwarfare.engine.Vector2;
import academicwarfare.assets.events.WeaponEvent;
import java.awt.BasicStroke;
import java.awt.Color;
import java.awt.Graphics;
import java.awt.Graphics2D;
import java.awt.geom.AffineTransform;
import java.awt.image.AffineTransformOp;
import java.awt.image.BufferedImage;
import java.io.File;
import java.util.ArrayList;
import java.util.concurrent.CopyOnWriteArrayList;
import javax.sound.sampled.AudioInputStream;
import javax.sound.sampled.AudioSystem;
import javax.sound.sampled.Clip;

/**
 *
 * @author yigitpolat
 */
public class Weapon extends GameObject
{
    private float range;
    private float fireRate;
    private int damage;
    private int firing = 0;
    private Vector2 target;
    private WeaponEvent we;
    private BufferedImage original_image;
    private boolean texture_set;
    private Enemy lastEnemy;
            
    public void update()
    {
        float randomizer = (float) Math.random() * 10 - 20;
        float randomizer2 = (float) Math.random() * 10 - 20;
        
        for( GameObject o : this.getScene().getObjects())
        {
            if( (o != this) && (o.getTag() == 9 || o.getTag() == 10) && o.contains(getCenter()))
            {
                this.setPosition( new Vector2(getPosition().x + randomizer, getPosition().y + randomizer2));
                return;
            }
        }
    }
    public Weapon( GameScene s, float range, float fireRate)
    {
        super(s);
        this.range = range;
        this.fireRate = fireRate;
        target = new Vector2();
        firing = 3;
        we = new WeaponEvent();
        texture_set = true;
        lastEnemy = new Enemy( s);
        damage = 10;
        setTag(9);
    }
    
    public boolean isFiring()
    {
        return firing < 3;
    }
    
    public void fireAt( Enemy e)
    {
        lastEnemy = e;
        target = e.getCenter();
        firing = 0;
        playFireSound();
        e.dealDamage(getDamage());
        
        if( e.getHealth() <= 0)
            firing = 3;
    }
    
    public static void playFireSound()
    {
        try
        {
            Clip clip = AudioSystem.getClip();
            AudioInputStream ais = AudioSystem.getAudioInputStream( new File("Sounds/fire.wav") );
            clip.open(ais);
            clip.start();
        }
        catch(Exception e)
        {
            e.printStackTrace();
        }
    }
    
    public void rotate()
    {
        float H = target.y - getCenter().y;
        float W = target.x - getCenter().x;
        
        if( W != 0 && H != 0)
        {
            if( H > 0 && W > 0)
                setRotation( (float) (Math.atan(H/W) + Math.PI / 2));
            else if( H > 0 && W < 0)
                setRotation( (float) (Math.atan(H/W) - Math.PI / 2) );
            else if( H < 0 && W > 0)
                setRotation( (float) (Math.atan(H/W) + Math.PI / 2) );
            else if( H < 0 && W < 0)
                setRotation( (float) (Math.atan(H/W) - Math.PI / 2) );
        }
        
        
        // The required drawing location
        int drawLocationX = (int) getCenter().x;
        int drawLocationY = (int) getCenter().y;

        // Rotation information

        double rotationRequired = getRotation();
        double locationX = original_image.getWidth() / 2;
        double locationY = original_image.getHeight() / 2;
        AffineTransform tx = AffineTransform.getRotateInstance(rotationRequired, locationX, locationY);
        AffineTransformOp op = new AffineTransformOp(tx, AffineTransformOp.TYPE_BILINEAR);
        setTexture(op.filter(original_image, null));        
    }
    
    @Override
    public void setTexture( BufferedImage bi)
    {
        super.setTexture(bi);
        if( texture_set)
        {
            original_image = bi;
            texture_set = false;
        }
    }
    
            
    @Override
    public void processEvents( CopyOnWriteArrayList<GameObject> sceneObjects)
    {
        we.processWeapon(this, sceneObjects);
    }
    
    @Override
    public void drawEntity( Graphics g)
    {
        Graphics2D g2 = (Graphics2D) g;
        target = lastEnemy.getCenter();
        rotate();
        
        g.setColor(Color.red);
        g.drawOval( (int) (getCenter().x - range), (int) (getCenter().y - range), (int) (2*range), (int) (2*range));
        if( firing < 3)
        {
            g2.setStroke(new BasicStroke(5));
            g2.setColor(Color.white);
            g2.drawLine( (int) getCenter().x , (int) getCenter().y, (int) target.x, (int) target.y);
            firing++;
            g2.setStroke(new BasicStroke(1));
        }
        
        super.drawEntity(g); 
    }
            

    /**
     * @return the range
     */
    public float getRange() {
        return range;
    }

    /**
     * @param range the range to set
     */
    public void setRange(float range) {
        this.range = range;
    }

    /**
     * @return the fireRate
     */
    public float getFireRate() {
        return fireRate;
    }

    /**
     * @param fireRate the fireRate to set
     */
    public void setFireRate(float fireRate) {
        this.fireRate = fireRate;
    }

    /**
     * @return the damage
     */
    public int getDamage() {
        return damage;
    }

    /**
     * @param damage the damage to set
     */
    public void setDamage(int damage) {
        this.damage = damage;
    }
}
