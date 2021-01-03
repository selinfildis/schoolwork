/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package academicwarfare.assets;

import academicwarfare.engine.GameObject;
import academicwarfare.engine.Vector2;
import java.util.ArrayList;

/**
 *
 * @author yigitpolat
 */
public class Path 
{
    ArrayList<Vector2> points;
    int curPoint;
    
    public Path(ArrayList<Vector2> pts)
    {
        points = pts;
        curPoint = 0;
    }
    
    public Path()
    {
        points = new ArrayList<>();
        curPoint = 0;
    }
    
    public Vector2 getCurPoint()
    {
        return points.get(curPoint % points.size());
    }
    
    public void addPoint( float x, float y)
    {
        points.add( new Vector2( x, y) );
    }
    
    public void followPoint( GameObject o)
    {
        float alpha;
        float magnitude;
        float firstx, firsty;
        float lastx, lasty;
        float H, W;
        
        firstx = o.getVelocity().x;
        firsty = o.getVelocity().y;
        
        magnitude = (float) Math.sqrt( firstx*firstx + firsty*firsty);
        
        H = getCurPoint().y - o.getCenter().y;
        W = getCurPoint().x - o.getCenter().x;
        
        alpha = 0;
        if( W != 0 && H != 0)
        {
            if( H > 0 && W > 0)
                alpha = ( (float) (Math.atan(H/W)));
            else if( H > 0 && W < 0)
                alpha = ( (float) (Math.atan(H/W) - Math.PI) );
            else if( H < 0 && W > 0)
                alpha = ( (float) (Math.atan(H/W)));
            else if( H < 0 && W < 0)
                alpha = ( (float) (Math.atan(H/W) - Math.PI) );
        }
        else
        {
            if( W == 0 && H > 0)
                alpha = (float) Math.PI / 2;
            else if( W == 0 && H < 0)
                alpha = (float) -Math.PI / 2;
        }
        lastx = magnitude*( (float) Math.cos(alpha) );
        lasty = magnitude*( (float) Math.sin(alpha) );
        
        o.setVelocity( new Vector2( lastx, lasty));
    }
    
    public void nextPoint( GameObject o)
    {
        curPoint++;
    }
}
