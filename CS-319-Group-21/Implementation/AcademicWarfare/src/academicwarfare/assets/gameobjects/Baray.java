/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package academicwarfare.assets.gameobjects;

import academicwarfare.assets.GameScene;
import academicwarfare.engine.Vector2;

/**
 *
 * @author selin
 */
public class Baray extends Enemy{
    public Baray( GameScene s)
    {
        super(s);
        setTexture("Graphics/baray.png");
        setHealth(100);
        setSize( new Vector2( 80, 80));
    }
}
