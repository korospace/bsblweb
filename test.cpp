#include<iostream>

using namespace std;

main(){

float jumlah, total, rupiah, pertamax=15000, pertalite=10000, Premium=7000, PertaminaDEX, Solar=5000, pound; 
int pilih,satuan;
std::string namaSatuan;

cout<<"==============================================\n"<<endl;

cout<<"\tSPBU SMANTI"<<endl;

cout<<"1. Pertamax 15000-liter \n";

cout<<"2. Pertalite 10000-liter\n";

cout<<"3. Premium 7000-liter \n";

cout<<"5. Solar 5000-liter \n";

cout<<"=============================================="<<endl;

cout<<endl;

cout<<"Masukan pilihan Anda : ";cin>>pilih;

cout<<endl;

cout<<"==============================================\n"<<endl;

cout<<"\tSatuan\n"<<endl;

cout<<"1. Rupiah\n";

cout<<"2. Liter\n";

cout<<"=============================================="<<endl;

cout<<endl;

cout<<"Masukan pilihan Anda : ";cin>>satuan;

if (satuan == 1) {
    namaSatuan = "Rupiah";
} else {
    namaSatuan = "Liter";
}

cout<<endl;

if (pilih==1)

{

cout<<"\n1. Pertamax"<<endl;
cout<<"\n----------------------------------------------"<<endl;

// cout<<"Masukan harga pertamax : ";cin>>pertamax;
cout<<"Masukan jumlah ("+namaSatuan+") yang akan diisi : ";cin>>jumlah;

if(satuan == 1) {
    total = (1/pertamax)*jumlah;
    cout<<"total liter : "<<total<<endl;
} else {
    total = jumlah*pertamax;
    cout<<"total rupiah : "<<total<<endl;   
}

}

else if(pilih==2)

{

cout<<"\n2. Pertalite"<<endl;
cout<<"\n----------------------------------------------"<<endl;

// cout<<"Masukan harga pertalite : ";cin>>pertalite;
cout<<"Masukan jumlah ("+namaSatuan+") yang akan diisi : ";cin>>jumlah;

if(satuan == 1) {
    total = (1/pertalite)*jumlah;
    cout<<"total liter : "<<total<<endl;
} else {
    total = jumlah*pertalite;
    cout<<"total rupiah : "<<total<<endl;   
}

}

else if(pilih==3)

{

cout<<"\n3. Premium"<<endl;
cout<<"\n----------------------------------------------"<<endl;

// cout<<"Masukan harga premium : ";cin>>Premium;
cout<<"Masukan jumlah ("+namaSatuan+") yang akan diisi : ";cin>>jumlah;

if(satuan == 1) {
    total = (1/Premium)*jumlah;
    cout<<"total liter : "<<total<<endl;
} else {
    total = jumlah*Premium;
    cout<<"total rupiah : "<<total<<endl;   
}

}

else if(pilih==5)

{

cout<<"\n5. Solar"<<endl;
cout<<"\n----------------------------------------------"<<endl;

// cout<<"Masukan harga Solar : ";cin>>Solar;
cout<<"Masukan jumlah ("+namaSatuan+") yang akan diisi : ";cin>>jumlah;

if(satuan == 1) {
    total = (1/Solar)*jumlah;
    cout<<"total liter : "<<total<<endl;
} else {
    total = jumlah*Solar;
    cout<<"total rupiah : "<<total<<endl;   
}

}

// else {
//     printf("pilihan %s tidak ditemukan",pilih);
// }

cout<<"\n=============================================="<<endl;

}