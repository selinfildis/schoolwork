/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package academicwarfare.assets.gameobjects;

import academicwarfare.assets.GameScene;
import academicwarfare.engine.GameObject;
import academicwarfare.engine.Vector2;
import java.util.concurrent.CopyOnWriteArrayList;
import javax.swing.JOptionPane;

/**
 *
 * @author yigitpolat
 */
public class Tower extends GameObject
{
    public Tower( GameScene s)
    {
        super(s);
        setTag(41);
    }
    
    public void update()
    {
        for( GameObject o : this.getScene().getObjects())
        {
            if( (this != o) && o.getTag() == 1 && this.contains(o.getCenter()))
            {
                getScene().setObjects(new CopyOnWriteArrayList<>());
                JOptionPane.showMessageDialog(null, "GAME OVER!");
            }
        }
    }
}
