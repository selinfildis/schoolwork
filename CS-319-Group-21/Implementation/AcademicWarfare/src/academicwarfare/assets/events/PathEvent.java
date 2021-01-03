/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package academicwarfare.assets.events;

import academicwarfare.assets.gameobjects.Enemy;
import academicwarfare.engine.Event;
import academicwarfare.engine.Vector2;
import academicwarfare.assets.Path;

/**
 *
 * @author yigitpolat
 */
public class PathEvent implements Event
{
    public PathEvent()
    {
        
    }
    
    public float distance( Vector2 v1, Vector2 v2)
    {
        float x1,x2,y1,y2;
        
        x1 = v1.x;
        x2 = v2.x;
        y1 = v1.y;
        y2 = v2.y;
        
        return (float) Math.sqrt( (x2-x1)*(x2-x1)+(y2-y1)*(y2-y1));
    }
    
    public void processPathEvent( Path p, Enemy e)
    {
        float randomizer = (float) Math.random() * 10 + 5;
        
        if( distance( p.getCurPoint(), e.getCenter()) < randomizer)
        {
            p.nextPoint( e);
        }
        
        p.followPoint( e);
    }
}
