package com.activities;

import com.activities.R;

import ihealth.arduino.ArduinoCommunication;
import ihealth.utils.Patient;
import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

/** Patienten daten anzeigen, messungen anzeigen, messung starten */
public class PatientView extends iHealthSuperActivity {

	private static final String TAG = "PatientView";
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.patient_overview);
		
		RelativeLayout button3 = (RelativeLayout) findViewById(R.id.patient_overview_button_3);
		button3.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				Log.d(TAG, "click on Button 3");
				vibrate();

				Intent intent = new Intent(PatientView.this, NewMeasurement.class);
				startActivity(intent);
			}
		});
		
		RelativeLayout button1 = (RelativeLayout) findViewById(R.id.patient_overview_button_1);
		button1.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				Log.d(TAG, "click button : patientendaten anzeigen");
				vibrate();
				
				Intent intent = new Intent(PatientView.this, PatientDetailView.class);
				startActivity(intent);
			}
		});
		
		RelativeLayout button2 = (RelativeLayout) findViewById(R.id.patient_overview_button_2);
		button2.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				Log.d(TAG, "click button : messwerte anzeigen");
				vibrate();
				
				Intent intent = new Intent(PatientView.this, PatientMeasurement.class);
				startActivity(intent);
			}
		});
		
		// TODO make members of views
		setFontSegoeWPLight((TextView) findViewById(R.id.patient_overview_headline));
		setFontSegoeWPLight((TextView) findViewById(R.id.patient_overview_button_1_text_1));
		setFontSegoeWPLight((TextView) findViewById(R.id.patient_overview_button_1_text_2));
		setFontSegoeWPLight((TextView) findViewById(R.id.patient_overview_button_2_text_1));
		setFontSegoeWPLight((TextView) findViewById(R.id.patient_overview_button_2_text_2));
		setFontSegoeWPLight((TextView) findViewById(R.id.patient_overview_button_3_text_1));
		setFontSegoeWPLight((TextView) findViewById(R.id.patient_overview_button_3_text_2));
		setFontSegoeWPLight((TextView) findViewById(R.id.patient_overview_headline_1));
		setFontSegoeWPLight((TextView) findViewById(R.id.patient_overview_headline_2));
		
		
		

		// Restore preferences
		//SharedPreferences sp = getSharedPreferences(PREFS_NAME, Context.MODE_PRIVATE);
		setContent(Patient.getInstance());		
	}

	@Override
	public void readNewPatient(Patient p) {
		setContent(p);
		
	}
	
	private void setContent(Patient p) {
		TextView image_text = (TextView) findViewById(R.id.patient_overview_headline_2);
		image_text.setText(p.getFirstname()+" "+p.getLastname());
		
		TextView headline = (TextView) findViewById(R.id.patient_overview_headline);
		
		TextView sex = (TextView) findViewById(R.id.patient_overview_headline_1);
		if (p.getSex().equalsIgnoreCase("female")) {
			sex.setText("Frau");
			headline.setText("patientin");
		} else {
			sex.setText("Herr");
			headline.setText("patient");
		}
		
		ImageView image = (ImageView) findViewById(R.id.patient_overview_image); 
		int i = new Integer(p.getID()).intValue();
		switch (i) {
			
			case 2: image.setImageResource(R.drawable.patient_2);
				break;
			case 3: image.setImageResource(R.drawable.patient_3);
				break;
			case 4: image.setImageResource(R.drawable.patient_4);
				break;
			default: image.setImageResource(R.drawable.patient_1);
		}
		
	}
	
	@Override
	protected void onResume() {
		super.onResume();
		//SharedPreferences sp = getSharedPreferences(PREFS_NAME, Context.MODE_PRIVATE);
		setContent(Patient.getInstance());
	}
}
