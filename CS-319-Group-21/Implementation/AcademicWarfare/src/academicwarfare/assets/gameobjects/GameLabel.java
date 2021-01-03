/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package academicwarfare.assets.gameobjects;

import academicwarfare.assets.GameScene;
import academicwarfare.engine.GameObject;
import java.awt.Color;
import java.awt.Font;
import java.awt.Graphics;

/**
 *
 * @author selin
 */
public class GameLabel extends GameObject {
    String label;
    public GameLabel(GameScene s, String label){
        super(s);
        this.label = label;
    }
    
    @Override
    public void drawEntity(Graphics g)
    {
        g.setFont(new Font("Times New Roman", Font.BOLD, 45));
        g.setColor(Color.white);
        g.drawString(label, (int)(getPosition().x),(int)(getPosition().y));
    }
    public void setString( String label){
        this.label = label;
    
    }
    public String getString(){
        return this.label;
    }
}
