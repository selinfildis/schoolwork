/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package academicwarfare;

import academicwarfare.engine.Scene;
import academicwarfare.engine.GameEngine;
import academicwarfare.assets.scenes.IceScene;
import academicwarfare.assets.menuframes.MainMenu;
import academicwarfare.assets.scenes.ForestScene;
import academicwarfare.assets.scenes.GrassScene;
import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;
import javax.sound.sampled.AudioInputStream;
import javax.sound.sampled.AudioSystem;
import javax.sound.sampled.Clip;
import javax.swing.JFrame;

/**
 *
 * @author yigitpolat
 */
public class AcademicWarfare extends JFrame{

    GameEngine engine;
    
    public AcademicWarfare( int scene)
    {
        engine = new GameEngine();
        initScreen( scene);
    }

    private void initScreen(int scene ) 
    {
        //to be changed with a screen instead.
        Scene game_scr = null;
        if( scene == 0)
            game_scr = new IceScene();
        else if( scene == 1)
            game_scr = new GrassScene();
        else
            game_scr = new ForestScene();
        
        add(game_scr);
        setSize(800, 600);
        setTitle("Academic Warfare");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setLocationRelativeTo(null);
        
        //Init game engine.
        engine.setScene(game_scr);
        
    }    
    /**
     * @param args the command line arguments
     */
    public static void playMusic()
    {
        try
        {
            Clip clip = AudioSystem.getClip();
            AudioInputStream ais = AudioSystem.getAudioInputStream( new File("Sounds/music.wav") );
            clip.open(ais);
            clip.loop(Clip.LOOP_CONTINUOUSLY);
        }
        catch(Exception e)
        {
            e.printStackTrace();
        }
    }
    
    public static void main(String[] args)
    {
        playMusic();
        
        JFrame MenuFrame = new JFrame();
        MenuFrame.add( new MainMenu(MenuFrame));
        MenuFrame.setTitle("Academic Warfare");
        MenuFrame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        MenuFrame.setLocationRelativeTo(null);
        MenuFrame.pack();
        MenuFrame.setLocationRelativeTo(null);
        MenuFrame.setVisible(true);
        
    }
    
}
