/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package academicwarfare.engine.interactions;

import academicwarfare.engine.Vector2;

/**
 *
 * @author yigitpolat
 */
public class MouseInteraction extends Interaction
{
    /*
    * status:
    * 0: null
    * 1: mouse entered
    * 2: mouse leaved
    * 3: mouse pressed
    * 4: mouse released
    * 5: mouse dragged
    */
    
    public void mouseEntered( Vector2 pos)
    {
        setStatus(1);
        setInteractionVector(pos);
    }
    
    public void mouseExited( Vector2 pos)
    {
        setStatus(2);
        setInteractionVector(pos);
    }
    
    public void mousePressed( Vector2 pos)
    {
        setStatus(3);
        setInteractionVector(pos);
    }
    
    public void mouseReleased( Vector2 pos)
    {
        setStatus(4);
        setInteractionVector(pos);
    }    
    
    public void mouseDragged( Vector2 pos)
    {
        setStatus(5);
        setInteractionVector(pos);
    }
}
