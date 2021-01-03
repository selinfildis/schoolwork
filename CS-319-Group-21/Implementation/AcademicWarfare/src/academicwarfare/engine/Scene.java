/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package academicwarfare.engine;

import java.awt.Graphics;
import java.util.ArrayList;
import java.util.Collections;
import java.util.List;
import java.util.concurrent.CopyOnWriteArrayList;
import javax.swing.JPanel;
/**
 *
 * @author yigitpolat
 */
public class Scene extends JPanel
{
    private CopyOnWriteArrayList<GameObject> gameObjects;
    private CopyOnWriteArrayList<Event> events;
    
    public Scene()
    {
        gameObjects = new CopyOnWriteArrayList<>();
    }
    
    @Override
    public void paintComponent( Graphics g)
    {        
        super.paintComponent( g);
        for( GameObject o : getObjects())
        {
            o.drawEntity( g);
        }
    }

    /**
     * @return the gameObjects
     */
    public CopyOnWriteArrayList<GameObject> getObjects() {
        return gameObjects;
    }

    /**
     * @param gameObjects the gameObjects to set
     */
    public void setObjects(CopyOnWriteArrayList<GameObject> gameObjects) {
        this.gameObjects = gameObjects;
    }
    
    public void addObject( GameObject o)
    {
        gameObjects.add(o);
    }

    /**
     * @return the events
     */
    public CopyOnWriteArrayList<Event> getEvents() {
        return events;
    }

    /**
     * @param events the events to set
     */
    public void setEvents(CopyOnWriteArrayList<Event> events) {
        this.events = events;
    }

}
