/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package academicwarfare.assets.gameobjects;

import academicwarfare.assets.GameScene;
import academicwarfare.engine.GameObject;
import academicwarfare.assets.Path;
import academicwarfare.assets.events.PathEvent;
import academicwarfare.engine.Scene;
import academicwarfare.engine.Vector2;
import java.awt.Color;
import java.awt.image.BufferedImage;
import java.util.ArrayList;
import java.util.concurrent.CopyOnWriteArrayList;

/**
 *
 * @author yigitpolat
 */
public class Enemy extends GameObject
{
    private int health;
    private Path p;
    private PathEvent pevt;
    
    public Enemy( GameScene s)
    {
        super(s);
        setTag(1);
        pevt = new PathEvent();
    }
    
    public void dealDamage( int damage)
    {
        health -= damage;
        if( health <= 0)
        {
            die( 35);
        }
    }
    
    public void die( int bounty)
    {
        getScene().addPoints( bounty);
        getScene().addMoney( bounty);
        setPosition(new Vector2(-500, -500));
        setTexture( (BufferedImage) null);
        setVelocity( new Vector2());
    }

    @Override
    public void processEvents( CopyOnWriteArrayList<GameObject> sceneObjects)
    {
        if( p != null)
            pevt.processPathEvent(p, this);
    }
    
    @Override
    public void drawEntity(java.awt.Graphics g)
    {
        super.drawEntity(g);
        
    }
    
    /**
     * @return the health
     */
    public int getHealth() {
        return health;
    }

    /**
     * @param health the health to set
     */
    public void setHealth(int health) {
        this.health = health;
    }

    /**
     * @return the p
     */
    public Path getPath() {
        return p;
    }

    /**
     * @param enemypath the p to set
     */
    public void setPath(Path enemypath) {
        this.p = enemypath;
    }
}
