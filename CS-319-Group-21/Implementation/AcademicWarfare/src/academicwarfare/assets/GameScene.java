/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package academicwarfare.assets;

import academicwarfare.assets.events.DragEvent;
import academicwarfare.assets.gameobjects.AdvancedGun;
import academicwarfare.assets.gameobjects.BasicGun;
import academicwarfare.assets.gameobjects.BuyButton;
import academicwarfare.assets.gameobjects.Tile;
import academicwarfare.assets.gameobjects.GameLabel;
import academicwarfare.assets.gameobjects.Weapon;
import academicwarfare.engine.GameObject;
import academicwarfare.engine.Scene;
import academicwarfare.engine.Vector2;

/**
 *
 * @author yigitpolat
 */
public class GameScene extends Scene
{
    private GameLabel pointLabel;
    private GameLabel waveLabel;
    private GameLabel moneyLabel;
    private int points;
    private int wave;
    private int money;
    
    public GameScene()
    {
        points = 0;
        wave = 1;
        money = 50;
        initScene();
    }
    
    public void addTile( int x, int y, String texturepath, boolean movable)
    {
        Tile t = new Tile( this, x, y, texturepath, this, movable);
        addObject( t);
    }
    
    public void addWeapon( int weaponType)
    {
        Weapon w;
        if( weaponType == 0)
            w = new BasicGun(this);
        else
            w = new AdvancedGun(this);
        
        w.setSize( new Vector2( 80, 80));
        w.setPosition( new Vector2( 75, 75));
        w.setInteractionEvent( new DragEvent());
        addObject(w);
    }
    
    public final void initScene()
    {
        GameObject sidebar = new GameObject( this);
        sidebar.setSize( new Vector2(250, 600));
        sidebar.setPosition( new Vector2( 550, 0));
        sidebar.setTexture("Graphics/sidebar.png");
        addObject(sidebar);
        
        
        pointLabel = new GameLabel(this, "" + points);
        pointLabel.setPosition(new Vector2(580,60));
        addObject(pointLabel);

        
        waveLabel = new GameLabel(this, "" + wave);
        waveLabel.setPosition(new Vector2 (580, 150));
        addObject(waveLabel);
        
        GameLabel moneyText = new GameLabel( this, "Money");
        moneyText.setPosition( new Vector2(580, 300));
        addObject( moneyText);
        
        moneyLabel = new GameLabel(this, "$"+ money);
        moneyLabel.setPosition(new Vector2 (580, 350));
        addObject(moneyLabel);
        
        BuyButton bb1 = new BuyButton( this, 100,0);
        bb1.setTexture( "Graphics/Turret1.png");
        bb1.setSize( new Vector2( 80, 80));
        bb1.setPosition( new Vector2( 580, 150));
        addObject(bb1);
        
        BuyButton bb2 = new BuyButton( this, 400,1);
        bb2.setTexture( "Graphics/turret2.png");
        bb2.setSize( new Vector2( 80, 80));
        bb2.setPosition( new Vector2( 680, 150));
        addObject(bb2);
    }
    
    public Path createScenePath()
    {
        return null;
    }
  
    public void addPoints( int points)
    {
        setPoints( this.points + points);
    }

    public void setPoints(int points)
    {
        this.points = points;
        pointLabel.setString("" + points);
    }
    public int getPoints(){
        return points;
    }
    
    public void nextWave()
    {
        wave++;
        waveLabel.setString("" + wave);
    }
    
    public int getWave()
    {
        return wave;
    }
    
    public void addMoney( int amount)
    {
        money += amount;
        moneyLabel.setString("" + money);
    }
    
    public void spendMoney( int amount)
    {
        money -= amount;
        moneyLabel.setString("" + money);
    }
    
    public int getMoney()
    {
        return money;
    }
    
}

