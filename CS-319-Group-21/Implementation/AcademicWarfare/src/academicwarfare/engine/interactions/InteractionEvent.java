/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package academicwarfare.engine.interactions;

import academicwarfare.engine.Event;

/**
 *
 * @author yigitpolat
 */
public interface InteractionEvent extends Event
{
    /**
     * @param i
     * @param obj
     */
    public void processInteraction( Interaction i, Object obj);
}
