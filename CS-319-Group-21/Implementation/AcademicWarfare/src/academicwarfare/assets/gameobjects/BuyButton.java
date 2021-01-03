/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package academicwarfare.assets.gameobjects;

import academicwarfare.assets.GameScene;
import academicwarfare.assets.events.PressEvent;
import academicwarfare.engine.GameObject;
import academicwarfare.engine.interactions.Pressable;

/**
 *
 * @author yigitpolat
 */
public class BuyButton extends GameObject implements Pressable
{
    private int price;
    private int weaponType;
    
    public BuyButton( GameScene s, int price, int weaponType)
    {
        super(s);
        this.setInteractionEvent( new PressEvent());
        this.price = price;
        this.weaponType = weaponType;
    }
    
    public void buy()
    {
        if( getScene().getMoney() >= price)
        {
            getScene().spendMoney(price);
            getScene().addWeapon(weaponType);
            System.out.println("Money spent.");
        }
    }

    @Override
    public void onPress() 
    {
        buy();
    }
    
}
