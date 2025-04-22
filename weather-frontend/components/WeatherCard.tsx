import React from "react";

type WeatherProps = {
  city: string;
  temperature: number;
  description: string;
  icon: string;
};

const WeatherCard = ({ city, temperature, description, icon }: WeatherProps) => {
  return (
    <div className="card p-4 w-full max-w-sm bg-base-100 shadow-xl">
      <div className="text-xl font-bold mb-2">{city}</div>
      <div className="flex items-center gap-4">
        <img
          src={`http://openweathermap.org/img/wn/${icon}@2x.png`}
          alt={description}
          className="w-16 h-16"
        />
        <div>
          <p className="text-3xl font-semibold">{temperature}°C</p>
          <p className="text-gray-600 capitalize">{description}</p>
        </div>
      </div>
    </div>
  );
};

export default WeatherCard;
