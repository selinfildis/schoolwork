%%%%%%%%%%%%%%%%%%%%%%%%%%%%
%          PART 1          %
%%%%%%%%%%%%%%%%%%%%%%%%%%%%
A=imread('clown.bmp');
J=mat2gray(A, [0 255]);
%Averaging
A1 = conv2(J, ones(11,11)/121);
A2 = conv2(J, ones(31,31)/(31*31));
A3 = conv2(J, ones(61,41)/(61*41));
figure;
imshow(J);
figure;
imshow(A1(6:512-5,6:512-5));
figure;
imshow(A2(16:512-15, 16:512-15));
figure;
imshow(A3(31:512-30,31:512-30 ));
Noise c = 0.2
J1= J + (rand(512,512)*((0.5)*0.2));
A1 = conv2(J1, ones(11,11)/121);
A2 = conv2(J1, ones(31,31)/(31*31));
A3 = conv2(J1, ones(61,41)/(61*41));
figure;
imshow(A1(6:512-5,6:512-5));
figure;
imshow(A2(16:512-15, 16:512-15));
figure;
imshow(A3(31:512-30,31:512-30 ));
Noise c = 1
J2= J + (rand(512,512)*(0.5));
A1 = conv2(J2, ones(11,11)/121);
A2 = conv2(J2, ones(31,31)/(31*31));
A3 = conv2(J2, ones(61,41)/(61*41));
figure;
imshow(A1(6:512-5,6:512-5));
figure;
imshow(A2(16:512-15, 16:512-15));
figure;
imshow(A3(31:512-30,31:512-30 ));
%H values.
omega = -pi:pi/400:pi;
H11 = (1/11)*(1-exp(-1j*omega*11))./(1-exp(-1j*omega)); 
H31 = (1/31)*(1-exp(-1j*omega*31))./(1-exp(-1j*omega)); 
H61 = (1/61)*(1-exp(-1j*omega*61))./(1-exp(-1j*omega));
plot(omega,[abs(H11);abs(H31);abs(H61)]); 
axis([0, pi, 0, 1]);

%%%%%%%%%%%%%%%%%%%%%%%%%%%%
%          PART 2          %
%%%%%%%%%%%%%%%%%%%%%%%%%%%%

for m = 1:512
    for n = 2:512
        A1(m,n) = J(m,n)-J(m,n-1);
    end
end
figure;
imshow(A1(1:512,1:512));