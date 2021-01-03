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
public class Interaction 
{
    private Vector2 interactionVector;
    private int status;
    
    public Interaction()
    {
        interactionVector = new Vector2();
        status = 0;
    }
    
    public void clearStatus()
    {
        status = 0;
    }
    
    public void setInteractionVector( Vector2 v)
    {
        interactionVector = v;
    }
    
    public Vector2 getInteractionVector()
    {
        return interactionVector;
    }

    /**
     * @return the status
     */
    public int getStatus() {
        return status;
    }

    /**
     * @param status the status to set
     */
    public void setStatus(int status) {
        this.status = status;
    }
}
