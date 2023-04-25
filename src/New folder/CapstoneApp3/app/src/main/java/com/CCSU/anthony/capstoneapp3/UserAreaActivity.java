package com.CCSU.anthony.capstoneapp3;

import android.content.Intent;
import android.graphics.drawable.Drawable;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import java.util.Random;

public class UserAreaActivity extends AppCompatActivity {


    /*images*/
    int[] pics = {R.drawable.a0, R.drawable.a1, R.drawable.a2, R.drawable.a3, R.drawable.a4,
            R.drawable.a5, R.drawable.a6, R.drawable.a7, R.drawable.a8, R.drawable.a9, R.drawable.a10,
            R.drawable.a11, R.drawable.a12, R.drawable.a13, R.drawable.a14, R.drawable.a15};

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_user_area);

        final TextView welcomeMessage = (TextView) findViewById(R.id.tvWelcomeMsg);
        final ImageView iVpic = (ImageView) findViewById(R.id.iVpic);
        Button bLogout = (Button) findViewById(R.id.bLogout);
        final Intent intent = new Intent(UserAreaActivity.this, LoginActivity.class);
        bLogout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                UserAreaActivity.this.startActivity(intent);
            }
        });


        Random r = new Random();
        int i = r.nextInt((pics.length) - 1);
        if (i != pics.length) {
            Drawable d = getResources().getDrawable(pics[i], getApplicationContext().getTheme());
        /* if .setImageDrawable(d) doesn't work. try iVpic.setImageResource(pics[i])
         * and get rid of Drawable d.
         *
         *
         * -->or try using a Bitmap with the code below.<--
         *
         *
         * Bitmap bPic = BitmapFactory.decodeResource(this.getResources(), pics[i]);
         * iVpic.setImageBitmap(bpic);  <-- this would go in the case statement above "i++;"
         *
         *
         *                                                                              */
            switch (pics[i]) {
                case R.drawable.a0:
                    iVpic.setImageDrawable(d);
                    break;
                case R.drawable.a1:
                    iVpic.setImageDrawable(d);
                    break;
                case R.drawable.a2:
                    iVpic.setImageDrawable(d);
                    break;
                case R.drawable.a3:
                    iVpic.setImageDrawable(d);
                    break;
                case R.drawable.a4:
                    iVpic.setImageDrawable(d);
                    break;
                case R.drawable.a5:
                    iVpic.setImageDrawable(d);
                    break;
                case R.drawable.a6:
                    iVpic.setImageDrawable(d);
                    break;
                case R.drawable.a7:
                    iVpic.setImageDrawable(d);
                    break;
                case R.drawable.a8:
                    iVpic.setImageDrawable(d);
                    break;
                case R.drawable.a9:
                    iVpic.setImageDrawable(d);
                    break;
                case R.drawable.a10:
                    iVpic.setImageDrawable(d);
                    break;
                case R.drawable.a11:
                    iVpic.setImageDrawable(d);
                    break;
                case R.drawable.a12:
                    iVpic.setImageDrawable(d);
                    break;
                case R.drawable.a13:
                    iVpic.setImageDrawable(d);
                    break;
                case R.drawable.a14:
                    iVpic.setImageDrawable(d);
                    break;
                case R.drawable.a15:
                    iVpic.setImageDrawable(d);
                    break;
            }
        }
    }
}

