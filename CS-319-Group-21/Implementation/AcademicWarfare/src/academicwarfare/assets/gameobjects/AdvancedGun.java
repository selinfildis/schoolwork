/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package academicwarfare.assets.gameobjects;

import academicwarfare.assets.GameScene;

/**
 *
 * @author yigitpolat
 */
public class AdvancedGun extends Weapon
{
    public AdvancedGun( GameScene s)
    {
        super( s, 200, 15);
        setTexture( "Graphics/turret2.png");
        setDamage( 15);
    }
}
