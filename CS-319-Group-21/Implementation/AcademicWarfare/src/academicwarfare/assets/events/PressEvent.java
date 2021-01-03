/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package academicwarfare.assets.events;

import academicwarfare.engine.interactions.Interaction;
import academicwarfare.engine.interactions.InteractionEvent;
import academicwarfare.engine.interactions.MouseInteraction;
import academicwarfare.engine.interactions.Pressable;

/**
 *
 * @author yigitpolat
 */
public class PressEvent implements InteractionEvent
{
    private boolean clicked;
    public PressEvent()
    {
        clicked = false;
    }
            
    @Override
    public void processInteraction(Interaction i, Object obj) 
    {
        MouseInteraction mi = (MouseInteraction) i;
        
        if( mi.getStatus() == 3 && !clicked)
        {
            clicked = true;
        }
        
        if( mi.getStatus() == 4)
        {
            ((Pressable) obj).onPress();
            clicked = false;
        }
        
    }
    
}
