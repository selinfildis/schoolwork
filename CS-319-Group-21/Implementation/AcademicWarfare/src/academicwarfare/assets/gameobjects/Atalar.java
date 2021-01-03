/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package academicwarfare.assets.gameobjects;

import academicwarfare.assets.GameScene;
import academicwarfare.engine.Scene;
import academicwarfare.engine.Vector2;
import java.awt.image.ImageObserver;

/**
 *
 * @author yigitpolat
 */
public class Atalar extends Enemy
{
    public Atalar( GameScene s)
    {
        super(s);
        setTexture("Graphics/aa.png");
        setHealth(100);
        setSize( new Vector2( 80, 80));
    }
}
